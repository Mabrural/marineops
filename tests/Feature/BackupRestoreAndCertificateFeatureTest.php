<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use App\Models\Vessel;
use App\Models\VesselCertificate;
use App\Services\OperationalDataBackupService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BackupRestoreAndCertificateFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_platform_admin_can_access_backup_restore_page(): void
    {
        $user = User::factory()->create(['is_platform_admin' => false]);
        $admin = User::factory()->create(['is_platform_admin' => true]);

        $this->actingAs($user)->get(route('backup-restore.index'))->assertForbidden();
        $this->actingAs($admin)->get(route('backup-restore.index'))->assertOk();
    }

    public function test_backup_restore_and_reset_preserve_user_and_user_company_assignment(): void
    {
        Storage::fake('local');
        Storage::fake('public');

        $user = User::factory()->create(['is_platform_admin' => true]);
        $company = Company::create(['name' => 'Protected Company', 'is_active' => true, 'created_by' => $user->id]);
        DB::table('user_companies')->insert([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $regularUser = User::factory()->create(['is_platform_admin' => false]);
        DB::table('user_companies')->insert([
            'user_id' => $regularUser->id,
            'company_id' => $company->id,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $client = Client::create(['company_id' => $company->id, 'name' => 'Backup Client', 'created_by' => $user->id]);
        Storage::disk('public')->put('vessel-certificates/backup-photo.jpg', 'backup attachment');

        $service = app(OperationalDataBackupService::class);
        $backup = $service->create();

        Storage::disk('local')->assertExists($backup['path']);
        Storage::disk('public')->delete('vessel-certificates/backup-photo.jpg');
        $client->delete();

        $uploadedBackup = new UploadedFile(
            Storage::disk('local')->path($backup['path']),
            'marineops-backup.zip',
            'application/zip',
            UPLOAD_ERR_OK,
            true
        );
        $service->restoreUploaded($uploadedBackup);

        $this->assertDatabaseHas('clients', ['name' => 'Backup Client']);
        Storage::disk('public')->assertExists('vessel-certificates/backup-photo.jpg');
        $this->assertDatabaseHas('users', ['id' => $user->id]);
        $this->assertDatabaseHas('user_companies', ['user_id' => $user->id, 'company_id' => $company->id]);

        $service->reset();

        $this->assertDatabaseMissing('clients', ['name' => 'Backup Client']);
        Storage::disk('public')->assertMissing('vessel-certificates/backup-photo.jpg');
        $this->assertDatabaseHas('users', ['id' => $user->id]);
        $this->assertDatabaseHas('companies', ['id' => $company->id]);
        $this->assertDatabaseHas('user_companies', ['user_id' => $user->id, 'company_id' => $company->id]);
        $this->assertDatabaseHas('user_companies', ['user_id' => $regularUser->id, 'company_id' => $company->id]);

        $this->post('/login', ['email' => $regularUser->email, 'password' => 'password'])
            ->assertRedirect(route('dashboard', absolute: false));
        $this->assertAuthenticatedAs($regularUser);
    }

    public function test_platform_admin_can_restore_a_uploaded_zip_backup(): void
    {
        Storage::fake('local');
        Storage::fake('public');

        $admin = User::factory()->create(['is_platform_admin' => true]);
        $backup = app(OperationalDataBackupService::class)->create();
        $uploadedBackup = new UploadedFile(
            Storage::disk('local')->path($backup['path']),
            'marineops-backup.zip',
            'application/zip',
            UPLOAD_ERR_OK,
            true
        );

        $this->actingAs($admin)->post(route('backup-restore.restore'), ['backup_file' => $uploadedBackup])
            ->assertRedirect(route('backup-restore.index'))
            ->assertSessionHas('success');

        $this->actingAs($admin)->post(route('backup-restore.restore'), ['backup' => basename($backup['path'])])
            ->assertSessionHasErrors('backup_file');
    }

    public function test_platform_admin_can_create_a_downloadable_zip_backup(): void
    {
        Storage::fake('local');
        Storage::fake('public');

        $admin = User::factory()->create(['is_platform_admin' => true]);
        Storage::disk('public')->put('vessel-certificates/backup-photo.jpg', 'backup attachment');

        $this->actingAs($admin)->post(route('backup-restore.store'))
            ->assertDownload();
    }

    public function test_reset_requires_the_full_confirmation_phrase_and_preserves_accounts(): void
    {
        $admin = User::factory()->create(['is_platform_admin' => true]);
        $company = Company::create(['name' => 'Operational Company', 'is_active' => true, 'created_by' => $admin->id]);
        Client::create(['company_id' => $company->id, 'name' => 'Reset Client', 'created_by' => $admin->id]);

        $this->actingAs($admin)->post(route('backup-restore.reset'), ['confirmation' => 'RESET'])
            ->assertSessionHasErrors('confirmation');
        $this->assertDatabaseHas('clients', ['name' => 'Reset Client']);

        $this->actingAs($admin)->post(route('backup-restore.reset'), ['confirmation' => 'RESET SEMUA DATA'])
            ->assertRedirect(route('backup-restore.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('clients', ['name' => 'Reset Client']);
        $this->assertDatabaseHas('users', ['id' => $admin->id, 'is_platform_admin' => true]);
    }

    public function test_certificate_location_and_photo_are_optional_and_photo_can_be_replaced(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['is_platform_admin' => false]);
        $company = Company::create(['name' => 'Operating Company', 'is_active' => true, 'created_by' => $user->id]);
        DB::table('user_companies')->insert([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $vessel = Vessel::create(['company_id' => $company->id, 'name' => 'MV Test', 'created_by' => $user->id]);

        $this->actingAs($user)->post(route('vessel-certificates.store'), [
            'vessel_id' => $vessel->id,
            'name' => 'Optional Certificate',
            'issue_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'certificate_file' => UploadedFile::fake()->create('optional-certificate.pdf', 100, 'application/pdf'),
        ])->assertRedirect(route('vessel-certificates.index'));

        $this->assertDatabaseHas('vessel_certificates', [
            'name' => 'Optional Certificate',
            'lokasi' => null,
            'foto' => null,
        ]);

        $this->actingAs($user)->post(route('vessel-certificates.store'), [
            'vessel_id' => $vessel->id,
            'name' => 'Safety Certificate',
            'lokasi' => 'Jakarta',
            'issue_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'certificate_file' => UploadedFile::fake()->create('certificate.pdf', 100, 'application/pdf'),
            'foto' => UploadedFile::fake()->image('photo.jpg'),
        ])->assertRedirect(route('vessel-certificates.index'));

        $certificate = VesselCertificate::where('name', 'Safety Certificate')->firstOrFail();
        $oldPhoto = $certificate->foto;

        $this->assertSame('Jakarta', $certificate->lokasi);
        $this->assertNotNull($oldPhoto);
        Storage::disk('public')->assertExists($oldPhoto);

        $this->actingAs($user)->put(route('vessel-certificates.update', $certificate), [
            'vessel_id' => $vessel->id,
            'name' => 'Safety Certificate',
            'lokasi' => null,
            'issue_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'foto' => UploadedFile::fake()->image('replacement.png'),
        ])->assertRedirect(route('vessel-certificates.index'));

        $certificate->refresh();

        $this->assertNull($certificate->lokasi);
        $this->assertNotSame($oldPhoto, $certificate->foto);
        Storage::disk('public')->assertMissing($oldPhoto);
        Storage::disk('public')->assertExists($certificate->foto);

        $replacementPhoto = $certificate->foto;

        $this->actingAs($user)->put(route('vessel-certificates.update', $certificate), [
            'vessel_id' => $vessel->id,
            'name' => 'Safety Certificate',
            'issue_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'remove_foto' => true,
        ])->assertRedirect(route('vessel-certificates.index'));

        $certificate->refresh();

        $this->assertNull($certificate->foto);
        Storage::disk('public')->assertMissing($replacementPhoto);
    }
}
