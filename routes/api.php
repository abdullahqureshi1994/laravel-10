<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;

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
Route::get('login', function() {
    return response()->json(['message' => 'Unauthorized.'], 401);
});

Route::post('login', [UsersController::class, 'login']);

Route::middleware(['auth:api', 'verified'])->group(function () {
    // Posts
    Route::get('get-post/{id}', [PostsController::class, 'getPost']);
    Route::get('get-user-posts', [PostsController::class, 'getUserPosts']);
    Route::delete('delete-post/{id}', [PostsController::class, 'deletePost']);
    Route::post('update-post/{id}', [PostsController::class, 'updatePost']);
    Route::post('add-post', [PostsController::class, 'addPost']);

    // Comments
    Route::get('get-comment/{id}', [CommentsController::class, 'getComment']);
    Route::get('get-user-comments', [CommentsController::class, 'getUserComments']);
    Route::get('get-post-comments/{id}', [CommentsController::class, 'getPostComments']);
    Route::delete('delete-comment/{id}', [CommentsController::class, 'deleteComment']);
    Route::post('update-comment/{id}', [CommentsController::class, 'updateComment']);
    Route::post('add-comment', [CommentsController::class, 'addComment']);
});
