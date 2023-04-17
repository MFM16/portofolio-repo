<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\RegistrationController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/{nickname}', [HomeController::class, 'show']);

Route::prefix('admin')->group(function () {
    Route::post('/auth', [AuthController::class, 'authenticate']);
    Route::post('/registration', [RegistrationController::class, 'registrate']);

    Route::middleware('guest')->group(function () {
        Route::get('/auth', [AuthController::class, 'index'])->name('login');
        Route::get('/registration', [RegistrationController::class, 'index']);  
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::get('/logout', [AuthController::class, 'logout']);

        Route::prefix('profile')->group(function () {
            Route::get('/', [ProfileController::class, 'index']);
            Route::put('/', [ProfileController::class, 'update']);
            Route::get('/show/{id}', [ProfileController::class, 'show']);
        });

        Route::prefix('social')->group(function () {
            Route::get('/', [SocialController::class, 'index']);
            Route::post('/', [SocialController::class, 'store']);
            Route::put('/', [SocialController::class, 'update']);
            Route::get('/show/{id}', [SocialController::class, 'show']);
            Route::delete('/delete/{id}', [SocialController::class, 'destroy']);
        });
        
        Route::prefix('logo')->group(function () {
            Route::get('/', [LogoController::class, 'index']);
            Route::post('/', [LogoController::class, 'store']);
            Route::put('/', [LogoController::class, 'update']);
            Route::get('/show/{id}', [LogoController::class, 'show']);
            Route::delete('/delete/{id}', [LogoController::class, 'destroy']);
        });

        Route::prefix('skill')->group(function () {
            Route::get('/', [SkillController::class, 'index']);
            Route::post('/', [SkillController::class, 'store']);
            Route::put('/', [SkillController::class, 'update']);
            Route::get('/show/{id}', [SkillController::class, 'show']);
            Route::delete('/delete/{id}', [SkillController::class, 'destroy']);
        });
        
        Route::prefix('portofolio')->group(function () {
            Route::get('/', [PortofolioController::class, 'index']);
            Route::post('/', [PortofolioController::class, 'store']);
            Route::post('/image', [PortofolioController::class, 'storeImage']);
            Route::put('/', [PortofolioController::class, 'update']);
            Route::get('/show/{id}', [PortofolioController::class, 'show']);
            Route::delete('/delete/{id}', [PortofolioController::class, 'destroy']);
        });

        Route::prefix('post')->group(function () {
            Route::get('/', [PostController::class, 'index']);
            Route::post('/', [PostController::class, 'store']);
            Route::post('/image', [PostController::class, 'storeImage']);
            Route::put('/', [PostController::class, 'update']);
            Route::get('/show/{id}', [PostController::class, 'show']);
            Route::delete('/delete/{id}', [PostController::class, 'destroy']);
        });

        Route::prefix('client')->group(function () {
            Route::get('/', [ClientController::class, 'index']);
            Route::post('/', [ClientController::class, 'store']);
            Route::put('/', [ClientController::class, 'update']);
            Route::get('/show/{id}', [ClientController::class, 'show']);
            Route::delete('/delete/{id}', [ClientController::class, 'destroy']);
        });

        Route::prefix('feedback')->group(function () {
            Route::get('/', [FeedbackController::class, 'index']);
            Route::post('/', [FeedbackController::class, 'store']);
            Route::put('/', [FeedbackController::class, 'update']);
            Route::get('/show/{id}', [FeedbackController::class, 'show']);
            Route::delete('/delete/{id}', [FeedbackController::class, 'destroy']);
        });

        Route::put('/setting', [SettingController::class, 'update']);
    });
});

Route::get('verify/{token}', [RegistrationController::class, 'verify']);
Route::get('{nickname}/portofolio/detail/{slug}', [HomeController::class, 'portofolio_detail']);
Route::get('{nickname}/post/detail/{slug}', [HomeController::class, 'post_detail']);