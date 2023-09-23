<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardPostController;

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

// USERS
Route::get('/', [PageController::class, 'home']); 
Route::get('/home', [PageController::class, 'home']); 
Route::get('/musik', [PageController::class, 'musik']); 
Route::get('/rupa', [PageController::class, 'rupa']); 
Route::get('/sastra', [PageController::class, 'sastra']); 
// contact us
Route::post('/contactUs', [PageController::class, 'contactUs']);
// view post
Route::get('/post/{post:slug}', [PageController::class, 'post']);

// SLUG CREATE
Route::get('/admin/posts/insert/checkSlug', [AdminController::class, 'createSlug']);

// ADMIN
Route::get('/admin', [AdminController::class, 'dashboard'])->middleware('auth'); 
Route::get('/admin/posts', [AdminController::class, 'posts'])->middleware('auth');
Route::get('/admin/posts/insert', [AdminController::class, 'insert'])->middleware('auth');
Route::post('/admin/posts/insert/createPost', [AdminController::class, 'createPost'])->middleware('auth');

Route::get('/admin/posts/edit/{post:slug}', [AdminController::class, 'edit'])->middleware('auth');
Route::post('/admin/posts/edit/editPost', [AdminController::class, 'editPost'])->middleware('auth');

Route::get('/admin/posts/preview/{post:slug}', [AdminController::class, 'preview'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');


// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');