<?php

use App\Http\Controllers\BackupController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HistoryRecordController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('loginw');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/doctors', DoctorController::class);
    Route::resource('/history-records', HistoryRecordController::class);
    Route::resource('patients', PatientController::class);
    Route::get('/cities/{state}', [PatientController::class, 'getCitiesByState']);
    Route::get('/municipalities/{state}', [PatientController::class, 'getMunicipalitiesByState']);
    Route::get('/parishes/{municipality}', [PatientController::class, 'getParishesByMunicipality']);
    Route::post('/backup/create', [BackupController::class, 'create'])->name('backup.create');
    Route::resource('home', HomeController::class);
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/data', [HomeController::class, 'data'])->name('data');

    // Rutas para ver y editar registros médicos
    Route::get('/medical-records/{id}', [HomeController::class, 'show'])->name('medical-records.show');
    Route::get('/medical-records/{id}/edit', [HomeController::class, 'edit'])->name('medical-records.edit');});

require __DIR__ . '/auth.php';
