<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PublicationController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\AudioController;
use App\Http\Controllers\Api\SlideController;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NewsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Routes that require authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/users/{id}', [AuthController::class, 'update']);
});



Route::resource('news', NewsController::class);
Route::get('news/categories', [NewsController::class, 'categories']);
Route::resource('publications', PublicationController::class);
Route::get('publication_categories', [PublicationController::class, 'publicationCategories']);
Route::get('publication_categories/{id}', [PublicationController::class, 'publicationCategory']);
Route::get('publication_related_items/{id}', [PublicationController::class, 'relatedItems']);

Route::resource('videos', VideoController::class);
Route::resource('images', ImageController::class);
Route::resource('audios', AudioController::class);
Route::resource('slides', SlideController::class);
