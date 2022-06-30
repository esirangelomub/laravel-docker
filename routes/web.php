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

Route::get('/', [DirectoriesController::class, 'index']);
Route::get('/create', [DirectoriesController::class, 'create']);
Route::get('{directories_id}/create', [DirectoriesController::class, 'create']);
Route::post('/', [DirectoriesController::class, 'store']);
Route::post('/search', [DirectoriesController::class, 'search']);
Route::get('{id}/edit', [DirectoriesController::class, 'edit']);
Route::put('{id}', [DirectoriesController::class, 'update']);
Route::get('{id}/delete', [DirectoriesController::class, 'delete']);
Route::delete('{id}', [DirectoriesController::class, 'destroy']);

Route::get('{directories_id}/files', [FilesController::class, 'index']);
Route::get('{directories_id}/files/create', [FilesController::class, 'create']);
Route::get('{directories_id}/files/{id}/edit', [FilesController::class, 'edit']);
Route::post('{directories_id}/files', [FilesController::class, 'store']);
Route::post('{directories_id}/files/search', [FilesController::class, 'search']);
Route::put('{directories_id}/files/{id}', [FilesController::class, 'update']);
Route::get('{directories_id}/files/{id}/delete', [FilesController::class, 'delete']);
Route::delete('{directories_id}/files/{id}', [FilesController::class, 'destroy']);
