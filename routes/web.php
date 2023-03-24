<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostRequestController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\StatisticalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPostController;
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

Auth::routes(['verify' => true]);

Route::prefix('manager')->middleware('verified')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::resource('posts', PostController::class)->only([
            'index', 'create', 'store', 'edit', 'update', 'destroy',
        ]);

        Route::post('/posts/move', [PostController::class, 'movePostsById'])->name('posts.move');

        Route::resource('users', UserController::class)->middleware('role:admin')->only([
            'index', 'create', 'store', 'edit', 'update', 'destroy',
        ]);

        Route::post('/users/delete-multiple', [UserController::class, 'deleteMultiple'])->name('users.deleteMultiple');

        Route::resource('users.posts', UserPostController::class)->middleware('role:admin')->only([
            'index',
        ]);

        Route::post('/users/{user}/verify', [UserController::class, 'verify'])->name('users.verify');
        Route::post('/users/{user}/posts/move', [UserPostController::class, 'movePosts'])->name('users.posts.move');
        Route::post('/users/{user}/posts/move-all', [UserPostController::class, 'moveAllPost'])->name('users.posts.move-all');

        Route::resource('post-requests', PostRequestController::class)->only([
            'index', 'store', 'destroy',
        ]);

        Route::get('/posts/rented', [PostController::class, 'rented'])->name('posts.rented-list');
        Route::post('/posts/{post}/hide', [PostController::class, 'hide'])->name('posts.hide');

        Route::post('/post-requests/{post_request}/read', [PostRequestController::class, 'read'])->name('post-requests.read');
        Route::post('/post-requests/{post_request}/unread', [PostRequestController::class, 'unread'])->name('post-requests.unread');

        Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');

        Route::post('/users/move-posts', [PostController::class, 'movePosts'])->name('users.move-posts');

        Route::get('/statistical', [StatisticalController::class, 'index'])->middleware('role:admin')->name('statistical');

        Route::get('/account/edit', [UserController::class, 'editAccount'])->name('account.edit');
        Route::post('/account/update', [UserController::class, 'updateAccount'])->name('account.update');
    });
});

Route::middleware([])->group(function () {
    Route::get('/email/verify', function () {
        return redirect()->route('home')->with('warning', 'Tài khoản chưa được xác thực. Vui lòng liên hệ quản trị viên để biết thêm thông tin.');
    })->middleware('auth')->name('verification.notice');
    Route::get('/', [PublicController::class, 'home'])->name('home');
    Route::get('/bai-dang', [PublicController::class, 'posts'])->name('posts');
    Route::get('/bai-dang/{post:slug}', [PublicController::class, 'post'])->name('post');

    Route::post('/posts/{post}/verify', [PostController::class, 'verify'])->name('posts.verify');
    Route::post('/posts/{post}/deny', [PostController::class, 'deny'])->name('posts.deny');
    // Route::post('/post-requests', [PostRequestController::class, 'store'])->name('post-requests.store');
    Route::get('/update', [PublicController::class, 'update'])->name('update');
});
