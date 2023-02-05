<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReportController;

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

Route::get('/', [LevelController::class, 'index']);
Route::get('/level/{id}',[LevelController::class, 'show']);
Route::get('/newlevel',[LevelController::class, 'create']);
Route::post('/newlevelmade', [LevelController::class, 'store']);
Route::post('/newlevel', [LocationController::class, 'store']);
Route::get('/attempt/{id}', [UserController::class, 'levelTakeOn']);
Route::get('/completed/{id}', [HistoryController::class, 'store']);
Route::get('/comment', [CommentController::class, 'store']);
Route::get('/commentdelete/{id}', [CommentController::class, 'destroy']);
Route::get('/delete/{id}',[LevelController::class, 'destroy']);
Route::get('/report/{id}', [ReportController::class, 'create']);
Route::post('/reportsave', [ReportController::class, 'store']);

Route::post('/search', [LevelController::class, 'searchLevels']);

Route::get('/dashboard', [LevelController::class, 'getPlayerLevels']);

Route::group(['middleware' => ['IsAdmin']], function () {
    Route::get('/reports', [ReportController::class, 'index']);
});



require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
