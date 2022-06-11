<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostRequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::prefix('manager')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::resource('posts', PostController::class)->only([
            'index', 'create', 'store', 'edit', 'update', 'destroy',
        ]);

        Route::resource('users', UserController::class)->middleware('role:admin')->only([
            'index', 'create', 'store', 'edit', 'update', 'destroy',
        ]);

        Route::resource('post-requests', PostRequestController::class)->only([
            'index', 'store', 'destroy',
        ]);

        Route::get('/posts/rented', [PostController::class, 'rented'])->name('posts.rented-list');
        Route::post('/posts/{post}/hide', [PostController::class, 'hide'])->name('posts.hide');

        Route::post('/post-requests/{post_request}/read', [PostRequestController::class, 'read'])->name('post-requests.read');
        Route::post('/post-requests/{post_request}/unread', [PostRequestController::class, 'unread'])->name('post-requests.unread');

        Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');

        Route::post('/users/move-posts', [PostController::class, 'movePosts'])->name('users.move-posts');

        Route::get('/update', [PublicController::class, 'update'])->name('update');
    });
});

Route::middleware([])->group(function () {
    Route::get('/', [PublicController::class, 'home'])->name('home');
    Route::get('/bai-dang', [PublicController::class, 'posts'])->name('posts');
    Route::get('/bai-dang/{post:slug}', [PublicController::class, 'post'])->name('post');

    Route::post('/posts/{post}/verify', [PostController::class, 'verify'])->name('posts.verify');
    Route::post('/posts/{post}/deny', [PostController::class, 'deny'])->name('posts.deny');
    Route::post('/post-requests', [PostRequestController::class, 'store'])->name('post-requests.store');
});
