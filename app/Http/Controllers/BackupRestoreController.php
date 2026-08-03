<?php

namespace App\Http\Controllers;

use App\Services\OperationalDataBackupService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class BackupRestoreController extends Controller
{
    public function __construct(private readonly OperationalDataBackupService $backupService) {}

    public function index()
    {
        return view('backup-restore.index');
    }

    public function store(): BinaryFileResponse|RedirectResponse
    {
        try {
            $backup = $this->backupService->create();

            return response()
                ->download(
                    Storage::disk('local')->path($backup['path']),
                    basename($backup['path']),
                    ['Content-Type' => 'application/zip']
                )
                ->deleteFileAfterSend(true);
        } catch (Throwable $exception) {
            Log::error('Backup creation failed.', ['exception' => $exception]);

            return redirect()->route('backup-restore.index')->with('error', 'Backup data gagal dibuat. Silakan coba lagi.');
        }
    }

    public function restore(Request $request): RedirectResponse
    {
        $request->validate([
            'backup_file' => ['required', 'file', 'mimes:zip', 'max:512000'],
        ]);

        try {
            $this->backupService->restoreUploaded($request->file('backup_file'));

            return redirect()->route('backup-restore.index')->with('success', 'Backup berhasil dipulihkan. Data akun dan akses user tetap terlindungi.');
        } catch (Throwable $exception) {
            Log::error('Backup restore failed.', ['backup' => 'uploaded-file', 'exception' => $exception]);

            return redirect()->route('backup-restore.index')->with('error', 'Restore gagal. Data tidak diubah karena proses dipulihkan secara aman.');
        }
    }

    public function reset(Request $request): RedirectResponse
    {
        $request->validate(['confirmation' => ['required', 'in:RESET SEMUA DATA']]);

        try {
            $this->backupService->reset();

            return redirect()->route('backup-restore.index')->with('success', 'Seluruh data operasional berhasil dihapus. Akun dan akses user tetap tersedia.');
        } catch (Throwable $exception) {
            Log::error('Operational data reset failed.', ['exception' => $exception]);

            return redirect()->route('backup-restore.index')->with('error', 'Reset data gagal. Data tidak diubah karena proses dipulihkan secara aman.');
        }
    }
}
