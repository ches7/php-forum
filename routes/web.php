<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Show Edit Form
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware('auth');

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
