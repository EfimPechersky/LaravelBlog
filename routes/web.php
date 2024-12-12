<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistartionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentsController;
#Route::get('/', function () {
#    return view('welcome');
#});
Route::get('/registration', [RegistartionController::class, 'show_form'] );
Route::post('/registration', [RegistartionController::class, 'create_user'] );
Route::post('/login', [LoginController::class, 'login'] );
Route::get('/login', [LoginController::class, 'show_form'] );
Route::get('/logout', [LoginController::class, 'logout'] );
Route::get('/post/create', [PostController::class, 'show_create_form']);
Route::post('/post/create', [PostController::class, 'create_post']);
Route::get('/', [PostController::class, 'show_posts']);
Route::post('/post/change', [PostController::class, 'change_post']);
Route::get('/post/change/{postid}', [PostController::class, 'show_change_form']);
Route::post('/post/delete', [PostController::class, 'delete_post']);
Route::post('/post/publish', [PostController::class, 'publish_post']);
Route::post('/post/unpublish', [PostController::class, 'unpublish_post']);
Route::post('/comment/create', [CommentsController::class, 'create_comment']);
Route::post('/comment/delete', [CommentsController::class, 'delete_comment']);