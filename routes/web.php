<?php

use App\Http\Controllers\User\IndexController;
use App\Http\Controllers\User\UpdateController;
use App\Http\Controllers\User\NovelController;
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

/**
 * 小説一覧
 */
Route::get('/novelList', [NovelController::class, 'list'])->name('novelList');

/**
 * 小説
 */
Route::get('/novel/{novelId}', [NovelController::class, 'index'])->name('novel');

/**
 * 小説ロック解除処理
 */
Route::post('/novel/{novelId}', [NovelController::class, 'cancelLock'])->name('novel.cancelLock');
