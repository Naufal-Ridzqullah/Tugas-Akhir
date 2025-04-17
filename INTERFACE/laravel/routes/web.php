<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Data\DataController;
use App\Http\Controllers\PerintahController;
use App\Http\Controllers\DataExportController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LuasBangunanController;
use App\Http\Controllers\EnergiLogController;

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DataController::class, 'dashboard', 'energiLogs'])->name('dashboard');
    Route::get('/dashboard/data-realtime', [DataController::class, 'dataRealtime'])->name('dashboard.data-realtime');
    Route::get('/dashboard/latest-data', [DataController::class, 'latestDataWeb'])->name('dashboard.latest-data');
    Route::post('/dashboard/relay/toggle', [PerintahController::class, 'toggle'])->name('dashboard.relay.toggle');
    Route::get('/dashboard/relay/status', [PerintahController::class, 'status'])->name('dashboard.relay.status');
    Route::get('/dashboard/resetenergi/statusenergi', [PerintahController::class, 'statusenergi'])->name('dashboard.energi.status');
    Route::post('/dashboard/resetenergi/toggleenergi', [PerintahController::class, 'toggleenergi'])->name('dashboard.energi.toggle');
    Route::get('/dashboard/resetwifi/statuswifi', [PerintahController::class, 'statuswifi'])->name('dashboard.wifi.status');
    Route::post('/dashboard/resetwifi/togglewifi', [PerintahController::class, 'togglewifi'])->name('dashboard.wifi.toggle');
    Route::post('/dashboard/save-luas', [LuasBangunanController::class, 'saveLuas'])->name('dashboard.save-luas');
    Route::get('/dashboard/energi-log', [EnergiLogController::class, 'fuzzy'])->name('dashboard.energi-log');
    Route::get('/get-fuzzy', [EnergiLogController::class, 'fuzzyJson'])->name('get.fuzzy');

    
    Route::get('/tabel', [DataController::class, 'tabel'])->name('tabel');
    Route::get('/grafik', [GrafikController::class, 'grafikMonitoring'])->name('grafik');
    Route::post('/monitoring/export-pdf', [GrafikController::class, 'exportPdf'])->name('grafik.export-pdf');
    Route::post('/export-data', [DataExportController::class, 'export'])->name('export.data');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route tanpa middleware (akses publik)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/', function () {
    return view('home');
})->name('home');
