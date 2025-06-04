<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\AdminRoleController;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [ContentController::class, 'posts']);
Route::get('/videos', [ContentController::class, 'videos']);

Route::post('/posts/{post}/comments', [ContentController::class, 'storePostComment'])
    ->name('posts.comments.store'); 
Route::post('/videos/{video}/comments', [ContentController::class, 'storeVideoComment'])
    ->name('videos.comments.store');

//Authorization
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin-only routes

Route::middleware([RoleMiddleware::class . ':Admin'])->group(function () {
    Route::get('/admin/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
    Route::delete('/admin/posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');

    
    Route::get('/admin/comments', [AdminCommentController::class, 'index'])->name('admin.comments.index');
    Route::delete('/admin/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('admin.comments.destroy');
});

// User routes (non-admin)
Route::middleware(['auth'])->group(function () {
    Route::delete('/comments/{id}', [ContentController::class, 'destroyComment'])->name('comments.destroy');
});

//Delete Route 
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/test-role', function () {
    return 'You are an admin!';
})->middleware(['auth', 'role:Admin']);

//Admin gives role
Route::middleware(['auth', PermissionMiddleware::class . ':manage roles'])->group(function () {
    Route::get('/admin/roles', [AdminRoleController::class, 'index'])->name('admin.roles.index');
    Route::post('/admin/roles/{user}/assign', [AdminRoleController::class, 'assign'])->name('admin.roles.assign');
});


require __DIR__.'/auth.php';
