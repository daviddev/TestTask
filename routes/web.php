<?php

use App\Http\Controllers\Api\ScoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LinkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'create']);
Route::post('/', [UserController::class, 'store']);
Route::view('/error', 'error')->name('error');

Route::middleware('check-link')->prefix('game')->group(function () {
    Route::get('/{key}', [LinkController::class, 'show'])->name('links.show');
    Route::post('/{key}/link', [LinkController::class, 'store']);
    Route::post('/{key}/link/{link}/deactivate', [LinkController::class, 'deactivateLink']);
    Route::post('/{key}/score', [ScoreController::class, 'store']);
    Route::get('/{key}/score', [ScoreController::class, 'index']);
});
