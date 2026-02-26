<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\UserCompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VesselController;
use App\Http\Controllers\VesselCertificateController;
use App\Http\Controllers\ProjectDocumentTypeController;
use App\Http\Controllers\ProjectDocumentUploadController;
use App\Http\Controllers\ProjectVesselController;
use App\Http\Controllers\ProjectVoyageController;
use App\Http\Controllers\ProjectTimesheetController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/storage/{folder}/{filename}', function ($folder, $filename) {
    $allowedFolders = ['vessel-certificates', 'project-documents'];

    if (!in_array($folder, $allowedFolders)) {
        abort(403);
    }

    $path = storage_path('app/public/' . $folder . '/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '.*');

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// super admin
Route::middleware(['auth', 'verified', 'platform.admin'])->group(function () {
    Route::resource('companies', CompanyController::class);

    Route::resource('user-management', UserController::class);

    // Custom actions
    Route::post('/user-management/{user:slug}/grant-admin', [UserController::class, 'grantAdmin'])->name('user-management.grant-admin');

    Route::post('/user-management/{user:slug}/revoke-admin', [UserController::class, 'revokeAdmin'])->name('user-management.revoke-admin');

    Route::post('/user-management/{user:slug}/activate', [UserController::class, 'activate'])->name('user-management.activate');

    Route::post('/user-management/{user:slug}/deactivate', [UserController::class, 'deactivate'])->name('user-management.deactivate');

    Route::get('/user-company-assign', [UserCompanyController::class, 'index'])->name('user-company-assign.index');

    Route::get('/user-company-assign/create/{id}', [UserCompanyController::class, 'create'])->name('user-company-assign.create');
    Route::post('user-company-assign/{id}', [UserCompanyController::class, 'store'])->name('user-company-assign.store');

    Route::delete('/user-company-assign/{user}', [UserCompanyController::class, 'destroy'])->name('user-company-assign.destroy');

    Route::resource('document-types', ProjectDocumentTypeController::class);
});

// internal operasion
Route::middleware(['auth', 'verified', 'non.platform.admin'])->group(function () {
    Route::resource('clients', ClientController::class);
    Route::resource('ports', PortController::class);
    Route::resource('vessels', VesselController::class);
    Route::resource('cargos', CargoController::class);
    Route::resource('periods', PeriodController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('crews', CrewController::class);

    Route::post('/projects/{project}/documents/{documentType}/upload', [ProjectDocumentUploadController::class, 'store'])->name('project-documents.upload');
    Route::delete('/projects/{project}/documents/{documentType}', [ProjectDocumentUploadController::class, 'destroy'])->name('project-documents.destroy');
    Route::delete('/projects/{project}/vessels/{projectVessel}', [ProjectVesselController::class, 'destroy'])->name('projects.vessels.destroy');
    Route::post('/projects/{project}/vessels', [ProjectVesselController::class, 'store'])->name('projects.vessels.store');
    Route::delete('/projects/{project}/voyage/{voyage}', [ProjectVoyageController::class, 'destroy'])->name('projects.voyage.destroy');
    Route::post('/projects/{project}/voyage', [ProjectVoyageController::class, 'store'])->name('projects.voyage.store');
    Route::put('/projects/{project}/voyage/{voyage}', [ProjectVoyageController::class, 'update'])->name('projects.voyage.update');

    Route::delete('/projects/{project}/timesheets/{timesheet}', [ProjectTimesheetController::class, 'destroy'])->name('projects.timesheets.destroy');
    Route::post('/projects/{project}/timesheets', [ProjectTimesheetController::class, 'store'])->name('projects.timesheets.store');
    Route::put('/projects/{project}/timesheets/{timesheet}', [ProjectTimesheetController::class, 'update'])->name('projects.timesheets.update');

    Route::resource('vessel-certificates', VesselCertificateController::class);
});

// filter global session set period
Route::post('/set-period', function (\Illuminate\Http\Request $request) {
    session([
        'active_period_id' => $request->period_id,
    ]);

    return redirect()->back();
})->name('set.period');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
