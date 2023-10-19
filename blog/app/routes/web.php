<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

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

Route::get('/fiddles', [FiddleController::class, 'index']);

Route::get('/', [BlogController::class, 'index']);
Route::get('/blogposts/{id}', [BlogController::class, 'viewBlogpost'])->whereNumber('id');
Route::get('/authors/{id}', [BlogController::class, 'viewAuthor'])->whereNumber('id');
Route::get('/categories/{id}', [BlogController::class, 'viewCategory'])->whereNumber('id');

Route::get('/blogposts/create', [BlogController::class, 'showCreateBlogpost'])->middleware('auth');
Route::post('/blogposts/create', [BlogController::class, 'createBlogpost'])->middleware('auth');
Route::post('/blogposts/{blogpost}/delete', [BlogController::class, 'deleteBlogpost'])->middleware(['auth', 'can:delete-post,blogpost']);

Route::get('/blogposts/search', [BlogController::class, 'searchBlogpost']);

Route::post('/api/login', [ApiController::class, 'loginSanctum']);
Route::post('/api/logout', [ApiController::class, 'logoutSanctum']);

require __DIR__ . '/auth.php';
