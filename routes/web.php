<?php

use App\Http\Controllers\LoveController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/@{user:username}',[PublicProfileController::class,'show'])->name('profile.show');

Route::get('/',[PostController::class,'index'])->name('dashboard');

Route::get('/category/{category}',[PostController::class,'category'])->name('post.byCategory');

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/post/create',[PostController::class,'create'])->name('post.create');
    Route::post('/post/create',[PostController::class,'store'])->name('post.store');
    Route::get('/@{username}/{post:slug}',[PostController::class,'show'])->name('post.show');
    Route::post('/follow/{user}',[FollowerController::class,'followUnfollow'])->name('follow');
    Route::post('/love/{post}',[LoveController::class,'love'])->name('love');
    Route::get('/posts/{post:slug}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
