<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Apis\PostController;
use App\Http\Controllers\Apis\PostRequestController;
use App\Http\Controllers\Apis\UploadImageController;
use App\Http\Controllers\Apis\WardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserPostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('wards', WardController::class)->only(['index']);

Route::post('upload-single', [UploadImageController::class, 'uploadSingle'])->name('api.post-images.upload-single');
Route::get('posts/{post}/download-images', [PostController::class, 'downloadImages'])->name('api.posts.download');
Route::post('posts/export-excel', [PostController::class, 'exportExcel'])->name('api.posts.export');
Route::post('posts/export-excel-rented', [PostController::class, 'exportExcelRented'])->name('api.posts.export-rented');
Route::get('posts/featured', [PostController::class, 'featured'])->name('api.posts.featured');
Route::get('posts', [PostController::class, 'index'])->name('api.posts.index');
Route::get('post-requests/export-excel', [PostRequestController::class, 'exportExcel'])->name('api.post-requests.export');

Route::post('users/{user}/posts/export-excel', [UserPostController::class, 'exportExcel'])->name('api.users.posts.export');

Route::post('notifications/mark-as-read', [NotificationController::class, 'markAllAsRead'])->name('api.notifications.mark-all-as-read');
