<?php

use App\Http\Controllers\PerintahController;
use App\Http\Controllers\LuasBangunanController;
use App\Http\Controllers\EnergiLogController;
use App\Http\Controllers\Data\DataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('data/realtime', [DataController::class, 'receiveData']);
Route::post('data/save', [DataController::class, 'store']);
Route::post('fuzzy/save', [EnergiLogController::class, 'savefuzzy']);
Route::get('relay/command', [PerintahController::class, 'status']);
Route::get('resetenergi/command', [PerintahController::class, 'statusenergi']);
Route::get('resetwifi/command', [PerintahController::class, 'statuswifi']);
Route::get('luasbangunan/command', [LuasBangunanController::class, 'luas']);