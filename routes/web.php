<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\AttestationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccueilController;

/*
|--------------------------------------------------------------------------
| Public Routes (NO LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/

// Accueil
Route::get('/', [AccueilController::class, 'index'])->name('accueil');

// Public Internship Application
Route::get('/apply', [StagiaireController::class, 'publicApply'])->name('public.apply');
Route::post('/apply', [StagiaireController::class, 'publicSubmit'])->name('public.submit');

// Tracking System (No login)
Route::get('/track', [StagiaireController::class, 'track'])->name('public.track');
Route::post('/track', [StagiaireController::class, 'checkStatus'])->name('public.status');

// Public Certificate Landing Page
Route::get('/download-attestation/{id}/{dossier_number}', 
    [StagiaireController::class, 'publicShowDownload']
)->name('public.download-certificate');

// Actual File Binary Download
Route::get('/download-attestation/{id}/{dossier_number}/file', 
    [StagiaireController::class, 'publicDownloadFile']
)->name('public.download-certificate.file');


/*
|--------------------------------------------------------------------------
| Admin Routes (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gestion stagiaires
    Route::get('/stagiaires', [StagiaireController::class, 'index'])->name('stagiaires.index');
    Route::get('/stagiaires/create', [StagiaireController::class, 'create'])->name('stagiaires.create');
    Route::post('/stagiaires', [StagiaireController::class, 'store'])->name('stagiaires.store');
    Route::get('/stagiaires/{id}', [StagiaireController::class, 'show'])->name('stagiaires.show');
    Route::get('/stagiaires/{id}/edit', [StagiaireController::class, 'edit'])->name('stagiaires.edit');
    Route::put('/stagiaires/{id}', [StagiaireController::class, 'update'])->name('stagiaires.update');
    Route::delete('/stagiaires/{id}', [StagiaireController::class, 'destroy'])->name('stagiaires.destroy');

    // Actions statut
    Route::post('/stagiaires/{id}/accept', [StagiaireController::class, 'accept'])->name('stagiaires.accept');
    Route::post('/stagiaires/{id}/reject', [StagiaireController::class, 'reject'])->name('stagiaires.reject');
    Route::post('/stagiaires/{id}/pending', [StagiaireController::class, 'setPending'])->name('stagiaires.setPending');

    // Certificate (Admin)
    Route::get('/stagiaires/{id}/view-certificate', [StagiaireController::class, 'viewCertificate'])->name('stagiaires.view-certificate');
    Route::get('/stagiaires/{id}/download-certificate', [StagiaireController::class, 'downloadCertificate'])->name('stagiaires.download-certificate');

    // Export
    Route::get('/stagiaires/export-pdf', [StagiaireController::class, 'exportPdf'])->name('stagiaires.exportPdf');
    Route::get('/stagiaires/export-excel', [StagiaireController::class, 'exportExcel'])->name('stagiaires.exportExcel');

    // Attestations
    Route::get('/attestations', [AttestationController::class, 'index'])->name('attestations.index');
    Route::post('/attestations/generate', [AttestationController::class, 'generate'])->name('attestations.generate');
    Route::get('/attestations/{id}/view', [AttestationController::class, 'view'])->name('attestations.view');
    Route::get('/attestations/{id}/download', [AttestationController::class, 'download'])->name('attestations.download');

    // Profile Admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

/*
|--------------------------------------------------------------------------
| Auth routes (for Admin only)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';