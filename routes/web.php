<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirectoriesController;
use App\Http\Controllers\FilesController;
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

Route::resource('/', DirectoriesController::class);

Route::get('files/{directories_id}', [FilesController::class, 'index']);
Route::get('files/{directories_id}/create', [FilesController::class, 'create']);
Route::get('files/{directories_id}/edit', [FilesController::class, 'edit']);
Route::post('files/{directories_id}', [FilesController::class, 'store']);
Route::put('files/{directories_id}/{id}', [FilesController::class, 'update']);
Route::delete('files/{directories_id}/{id}', [FilesController::class, 'destroy']);
