<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\LinkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LinkController::class, 'index']);
Route::get('/{path}', [RedirectController::class, 'redirect'])->where('path', '[a-z]+');
Route::get('/links/latest', [LinkController::class, 'latest']);
Route::post('/links/store', [LinkController::class, 'store']);

