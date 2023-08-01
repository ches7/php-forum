<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ProfileController;

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

// All Posts
Route::get('/', [PostController::class, 'index']);

// Show Create Form
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth');

// Store Post Data
Route::post('/posts', [PostController::class, 'store'])->middleware('auth');

// Show Edit Post Form
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware('auth');

// Replies For Post
Route::get('/posts/{post}/replies', [ReplyController::class, 'index']);

// Store Reply Data
Route::post('/posts/{post}/replies', [ReplyController::class, 'store'])->middleware('auth');

// Show Edit Reply Form
Route::get('/posts/{post}/{reply}/edit', [ReplyController::class, 'edit'])->middleware('auth');

// Update Reply
Route::put('/posts/{post}/{reply}', [ReplyController::class, 'update'])->middleware('auth');

// Delete Reply
Route::delete('/posts/{post}/{reply}', [ReplyController::class, 'destroy'])->middleware('auth');

// Update Post
Route::put('/posts/{post}', [PostController::class, 'update'])->middleware('auth');

// Delete Post
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('auth');

// Single Post
Route::get('/posts/{post}', [PostController::class, 'show']);

Route::get('/dashboard', 

[PostController::class, 'dashboard']

// function () {
//     return view('dashboard');
// }

)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
