<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConcertController;
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

Route::get('/', [ConcertController::class, 'index']);

Route::get('/concerts', [ConcertController::class, 'showConcerts']);

Route::get('/search/{term}', [ConcertController::class, 'searchConcerts']);

Route::post('/concerts/{id}/toggle', [ConcertController::class, 'toggleConcert'])->whereNumber('id');

Route::get('/concerts/{id}', [ConcertController::class, 'showConcert'])->whereNumber('id');
Route::get('/concerts/{concert_id}/images/{img_id}', [ConcertController::class, 'showConcertImage'])->whereNumber(['concert_id', 'img_id']);