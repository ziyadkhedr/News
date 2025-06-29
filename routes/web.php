<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\Dashboard\NotificationController;
use App\Http\Controllers\Frontend\Dashboard\ProfileController;
use App\Http\Controllers\Frontend\Dashboard\SettingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsLetterController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\SearchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
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

Route::redirect("/","home");
Broadcast::routes(['middleware' => ['auth']]);

route::group(['as'=> 'frontend.'], function () {
    Route::get('/home', [HomeController::class,'index'])->middleware(['auth:web','verified'])->name('index');
    Route::post('news-latter', [NewsLetterController::class,'store'])->name('news.letter');
    Route::get('category/{slug}', [CategoryController::class,'__invoke'])->name('category.posts');
    //Post Routes
    Route::controller(PostController::class)->name('post.')->prefix('post/')->group(function () {
        Route::get('{slug}', 'show')->name('show');
        Route::get('comments/{slug}', 'getAllPosts')->name('getallposts');
        Route::post('comments/store', 'saveComments')->name('comments.store');
    });
    //contact us Routes
    Route::controller(ContactController::class)->name('contact.')->prefix('contact-us/')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('store', 'store')->name('store');
    });
    Route::match(['get','post'],'search', SearchController::class)->name('search');

    //manage profile page
    Route::prefix('account/')->name('dashboard.')->middleware(['auth:web','verified'])->group(function () {
        Route::controller(ProfileController::class)->name('')->group(function(){
            Route::get('profile','index')->name('profile');
            Route::post('post/store','storePost')->name('post.store');
            Route::delete('post/delete','deletePost')->name('post.delete');
            Route::get('post/get-comment/{id}','getComment')->name('post.getComment');
            Route::get('post/{slug}/edit','showEditPost')->name('post.edit');
            Route::put('post/update','updatePost')->name('post.update');
            Route::post('post/image/delete/{image_id}','deletePostImage')->name('post.image.delete');
        });
        //settings routes
        Route::controller(SettingController::class)->group(function () {
            Route::get('setting','index')->name('setting');
            Route::post('setting/update','update')->name('setting.update');
            Route::post('change-password','changePassword')->name('setting.changepassword');
        });
        //notification routes
        Route::prefix('notification')->name('notification.')->controller(NotificationController::class)->group(function () {
            Route::get('/','index')->name('index');
            Route::get('mark-read','markRead')->name('markRead');
            Route::post('delete','delete')->name('delete');
            Route::get('delete-all','deleteAll')->name('deleteAll');
        });
    });

    
});


Auth::routes();

Route::prefix('email/')->controller(VerificationController::class)->name('verification.')->group(function () {
    Route::get('verify', 'show')->name('notice');
    Route::get('verify/{id}/{hash}', 'verify')->name('verify');
    Route::post('resend', 'resend')->name('resend');
});

