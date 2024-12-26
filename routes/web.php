<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/',[HomepageController::class,'index'])->name('homepage');
Route::post('/', [HomepageController::class, 'contactForm'])->name('contactForm');

Route::get('/panel-login',[LoginController::class,'index'])->name('login');
Route::post('/panel-login',[LoginController::class,'store'])->name('loginStore');
//middleware(['auth'])->
Route::middleware(['auth'])->prefix('panel')->as('panel.')->group(function (){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/logout',LogoutController::class)->name('logout');

    Route::prefix('about')->as('about.')->group(function () {
        Route::get('/', [AboutController::class, 'index'])->name('index');
        Route::get('/data-list', [AboutController::class, 'dataList'])->name('dataList');
        Route::get('/create', [AboutController::class, 'create'])->name('create');
        Route::post('/create', [AboutController::class, 'store'])->name('store');
        Route::get('/edit/{about}', [AboutController::class, 'edit'])->name('edit');
        Route::post('/edit/{about}', [AboutController::class, 'update'])->name('update');
        Route::post('/destroy/{about}', [AboutController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('portfolio')->as('portfolio.')->group(function () {
        Route::get('/', [PortfolioController::class, 'index'])->name('index');
        Route::get('/data-list', [PortfolioController::class, 'dataList'])->name('dataList');
        Route::get('/create', [PortfolioController::class, 'create'])->name('create');
        Route::post('/create', [PortfolioController::class, 'store'])->name('store');
        Route::get('/edit/{portfolio}', [PortfolioController::class, 'edit'])->name('edit');
        Route::post('/edit/{portfolio}', [PortfolioController::class, 'update'])->name('update');
        Route::post('/destroy/{portfolio}', [PortfolioController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('setting')->as('setting.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::post('/data-list', [SettingController::class, 'dataList'])->name('dataList');
        Route::get('/create', [SettingController::class, 'create'])->name('create');
        Route::post('/create', [SettingController::class, 'store'])->name('store');
        Route::get('/edit/{setting}', [SettingController::class, 'edit'])->name('edit');
        Route::post('/edit/{setting}', [SettingController::class, 'update'])->name('update');
        Route::post('/destroy/{setting}', [SettingController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('message')->as('message.')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('index');
        Route::post('/data-list', [MessageController::class, 'dataList'])->name('dataList');
        Route::get('/show/{message}', [MessageController::class, 'show'])->name('show');
        Route::post('/destroy/{message}', [MessageController::class, 'destroy'])->name('destroy');
    });
});

