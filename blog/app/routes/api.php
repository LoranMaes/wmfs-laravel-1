<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/blogposts/featured', [ApiController::class, 'getFeatured']);
    Route::get('/blogposts/recent', [ApiController::class, 'getRecent']);
    Route::get('/blogposts', [ApiController::class, 'getBlogposts']);
    Route::get('/blogposts/{id}', [ApiController::class, 'getBlogpost'])->whereNumber('id');
    Route::post('/blogposts', [ApiController::class, 'addBlogpost']);
    Route::get('/categories/{id}', [ApiController::class, 'getCategory'])->whereNumber('id');
    Route::get('/authors/{id}', [ApiController::class, 'getAuthor'])->whereNumber('id');
    Route::get('/user', [ApiController::class, 'getUser']);
});
