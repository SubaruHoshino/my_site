<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UpdateController;
use Illuminate\Support\Facades\Route;

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

/**
 * トップ
 */
Route::get('/', [IndexController::class, 'index'])->name('index');

/**
 * 更新履歴一覧
 */
Route::get('/updateLogList', [UpdateController::class, 'list'])->name('updateLogList');

/**
 * 更新履歴
 */
Route::get('/updateLog/{updateLogId}', [UpdateController::class, 'index'])->name('updateLog');
