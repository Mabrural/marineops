<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;
use RuntimeException;

class OperationalDataBackupService
{
    private const FORMAT = 'marineops-operational-archive';

    private const VERSION = 2;

    /**
     * Tables containing operational and master data. Authentication, access
     * assignments, framework state, and migration history are intentionally excluded.
     */
    private const TABLES = [
        'companies',
        'project_document_types',
        'asset_groups',
        'clients',
        'ports',
        'vessels',
        'cargos',
        'periods',
        'projects',
        'vessel_certificates',
        'crews',
        'project_document_uploads',
        'project_vessels',
        'project_voyages',
        'project_timesheets',
        'assets',
        'asset_maintenance_logs',
        'amprahans',
        'agendas',
    ];

    /** Delete children before the records they reference. */
    private const DELETE_ORDER = [
        'asset_maintenance_logs',
        'project_document_uploads',
        'project_timesheets',
        'project_voyages',
        'project_vessels',
        'vessel_certificates',
        'amprahans',
        'assets',
        'projects',
        'crews',
        'vessels',
        'cargos',
        'ports',
        'clients',
        'periods',
        'agendas',
        'asset_groups',
        'project_document_types',
        'companies',
    ];

    /** Insert parents before their dependent records. */
    private const INSERT_ORDER = [
        'companies',
        'project_document_types',
        'asset_groups',
        'clients',
        'ports',
        'vessels',
        'cargos',
        'periods',
        'projects',
        'vessel_certificates',
        'crews',
        'project_document_uploads',
        'project_vessels',
        'project_voyages',
        'project_timesheets',
        'assets',
        'asset_maintenance_logs',
        'amprahans',
        'agendas',
    ];

    public function create(): array
    {
        $tables = [];

        foreach (self::TABLES as $table) {
            $tables[$table] = DB::table($table)->orderBy('id')->get()->map(fn ($row) => (array) $row)->all();
        }

        $payload = [
            'format' => self::FORMAT,
            'version' => self::VERSION,
            'created_at' => now()->toIso8601String(),
            'tables' => $tables,
        ];

        $filename = 'backups/marineops-backup-'.now()->format('Ymd-His-u').'.zip';
        $backupPath = Storage::disk('local')->path($filename);
        File::ensureDirectoryExists(dirname($backupPath));
        $temporaryJson = tempnam(sys_get_temp_dir(), 'marineops-backup-');

        try {
            file_put_contents($temporaryJson, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR));

            $zip = new \ZipArchive;
            if ($zip->open($backupPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
                throw new RuntimeException('Unable to create the backup archive.');
            }

            $zip->addFile($temporaryJson, 'database.json');
            $this->addAttachmentsToArchive($zip);
            $zip->close();
        } finally {
            if (is_file($temporaryJson)) {
                @unlink($temporaryJson);
            }
        }

        return [
            'path' => $filename,
            'created_at' => $payload['created_at'],
        ];
    }

    public function backups(): array
    {
        return collect(Storage::disk('local')->files('backups'))
            ->filter(fn (string $path) => str_ends_with($path, '.zip'))
            ->map(function (string $path) {
                return [
                    'path' => $path,
                    'name' => basename($path),
                    'size' => Storage::disk('local')->size($path),
                    'last_modified' => Storage::disk('local')->lastModified($path),
                ];
            })
            ->sortByDesc('last_modified')
            ->values()
            ->all();
    }

    public function restore(string $filename): void
    {
        if (basename($filename) !== $filename || ! str_ends_with($filename, '.zip')) {
            throw new RuntimeException('The selected backup file is not valid.');
        }

        $path = 'backups/'.$filename;

        if (! Storage::disk('local')->exists($path)) {
            throw new RuntimeException('The selected backup file was not found.');
        }

        $this->restoreArchive(Storage::disk('local')->path($path));
    }

    public function download(string $filename): StreamedResponse
    {
        if (basename($filename) !== $filename || ! str_ends_with($filename, '.zip')) {
            throw new RuntimeException('The selected backup file is not valid.');
        }

        $path = 'backups/'.$filename;

        if (! Storage::disk('local')->exists($path)) {
            throw new RuntimeException('The selected backup file was not found.');
        }

        return Storage::disk('local')->download($path, $filename, ['Content-Type' => 'application/zip']);
    }

    public function restoreUploaded(UploadedFile $backup): void
    {
        if (! $backup->isValid()) {
            throw new RuntimeException('The uploaded backup file is not valid.');
        }

        $this->restoreArchive($backup->getRealPath());
    }

    private function restoreArchive(string $archivePath): void
    {
        $backup = $this->readBackup($archivePath);
        $stagingPath = storage_path('app/framework/backup-restore/'.Str::uuid());
        $originalAttachmentsPath = storage_path('app/framework/backup-restore-original/'.Str::uuid());

        try {
            $this->extractAttachments($archivePath, $stagingPath);
            $this->copyCurrentAttachments($originalAttachmentsPath);
            $this->replaceAttachments($stagingPath);

            DB::transaction(function () use ($backup) {
                $this->deleteOperationalData();

                foreach (self::INSERT_ORDER as $table) {
                    $rows = $backup['tables'][$table] ?? [];

                    foreach ($rows as $row) {
                        // User-company assignments are preserved, so a company currently
                        // referenced by an account must not be overwritten or removed.
                        if ($table === 'companies' && $this->isProtectedCompany((int) $row['id'])) {
                            continue;
                        }

                        DB::table($table)->insert($row);
                    }
                }
            }, 3);
        } catch (\Throwable $exception) {
            $this->replaceAttachments($originalAttachmentsPath);
            throw $exception;
        } finally {
            File::deleteDirectory($stagingPath);
            File::deleteDirectory($originalAttachmentsPath);
        }
    }

    public function reset(): void
    {
        $originalAttachmentsPath = storage_path('app/framework/backup-reset-original/'.Str::uuid());

        try {
            $this->copyCurrentAttachments($originalAttachmentsPath);
            $this->clearAttachments();

            DB::transaction(function () {
                $this->deleteOperationalData();
            }, 3);
        } catch (\Throwable $exception) {
            $this->replaceAttachments($originalAttachmentsPath);
            throw $exception;
        } finally {
            File::deleteDirectory($originalAttachmentsPath);
        }
    }

    private function readBackup(string $archivePath): array
    {
        $zip = new \ZipArchive;

        try {
            if ($zip->open($archivePath) !== true || ($json = $zip->getFromName('database.json')) === false) {
                throw new RuntimeException('The selected backup archive is invalid.');
            }

            $backup = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException|RuntimeException $exception) {
            Log::warning('Invalid backup archive selected for restore.', ['backup' => basename($archivePath)]);
            throw new RuntimeException('The selected backup file is invalid or corrupted.', previous: $exception);
        } finally {
            $zip->close();
        }

        if (($backup['format'] ?? null) !== self::FORMAT || ($backup['version'] ?? null) !== self::VERSION || ! is_array($backup['tables'] ?? null)) {
            throw new RuntimeException('The selected backup file is not supported by this application.');
        }

        foreach (self::TABLES as $table) {
            if (! array_key_exists($table, $backup['tables']) || ! is_array($backup['tables'][$table])) {
                throw new RuntimeException('The selected backup file is incomplete.');
            }
        }

        return $backup;
    }

    private function addAttachmentsToArchive(\ZipArchive $zip): void
    {
        $attachmentsRoot = Storage::disk('public')->path('');

        if (! is_dir($attachmentsRoot)) {
            return;
        }

        foreach (File::allFiles($attachmentsRoot) as $file) {
            $relativePath = str_replace('\\', '/', $file->getRelativePathname());
            $zip->addFile($file->getPathname(), 'attachments/'.$relativePath);
        }
    }

    private function extractAttachments(string $archivePath, string $stagingPath): void
    {
        $zip = new \ZipArchive;

        if ($zip->open($archivePath) !== true) {
            throw new RuntimeException('The selected backup archive is invalid.');
        }

        try {
            File::ensureDirectoryExists($stagingPath);

            for ($index = 0; $index < $zip->numFiles; $index++) {
                $name = $zip->getNameIndex($index);

                if ($name === 'database.json') {
                    continue;
                }

                if (! str_starts_with($name, 'attachments/') || str_contains($name, '../') || str_contains($name, '..\\')) {
                    throw new RuntimeException('The selected backup archive contains an unsafe file path.');
                }

                $relativePath = substr($name, strlen('attachments/'));
                if ($relativePath === '' || str_ends_with($name, '/')) {
                    continue;
                }

                $targetPath = $stagingPath.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
                File::ensureDirectoryExists(dirname($targetPath));
                $stream = $zip->getStream($name);
                $target = fopen($targetPath, 'wb');

                if ($stream === false || $target === false) {
                    throw new RuntimeException('Unable to prepare attachment restoration.');
                }

                stream_copy_to_stream($stream, $target);
                fclose($stream);
                fclose($target);
            }
        } finally {
            $zip->close();
        }
    }

    private function copyCurrentAttachments(string $destination): void
    {
        $attachmentsRoot = Storage::disk('public')->path('');

        if (is_dir($attachmentsRoot)) {
            File::copyDirectory($attachmentsRoot, $destination);
        }
    }

    private function replaceAttachments(string $source): void
    {
        $attachmentsRoot = Storage::disk('public')->path('');
        $this->clearAttachments();

        if (is_dir($source)) {
            File::copyDirectory($source, $attachmentsRoot);
        }
    }

    private function clearAttachments(): void
    {
        $attachmentsRoot = Storage::disk('public')->path('');
        File::ensureDirectoryExists($attachmentsRoot);

        foreach (File::directories($attachmentsRoot) as $directory) {
            File::deleteDirectory($directory);
        }

        foreach (File::files($attachmentsRoot) as $file) {
            if ($file->getFilename() !== '.gitignore') {
                File::delete($file->getPathname());
            }
        }
    }

    private function deleteOperationalData(): void
    {
        foreach (self::DELETE_ORDER as $table) {
            $query = DB::table($table);

            if ($table === 'companies') {
                $protectedCompanyIds = DB::table('user_companies')->pluck('company_id')->all();

                if ($protectedCompanyIds !== []) {
                    $query->whereNotIn('id', $protectedCompanyIds);
                }
            }

            $query->delete();
        }
    }

    private function isProtectedCompany(int $companyId): bool
    {
        return DB::table('user_companies')->where('company_id', $companyId)->exists();
    }
}
