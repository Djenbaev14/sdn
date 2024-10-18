<?php

use App\Http\Controllers\AppealController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\frontend\VirtualController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Route;



// login
Route::get('/login', [AuthController::class, 'index'])->name('auth.index')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login')->middleware('guest');


Route::get('/', function () {
    return view('welcome');
})->middleware('auth');




// lang

Route::group(['prefix' => '','middleware' => 'auth'], function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/', [HomeController::class,'index'])->name('dashboard.index');
    

    Route::controller(MenuController::class)->prefix('menu')->group(function () {
        // index
        Route::get('/', 'index')->name('dashboard.menu.index');

        // create
        Route::get('/create', 'create')->name('dashboard.menu.create');
        Route::post('/store','store')->name('dashboard.menu.store');
        // // edit
        Route::post('/item_add', 'item_add')->name('dashboard.menu.item_add');

        // // update
        Route::post('/update/{menu}', 'update')->name('dashboard.menu.update');

        // // delete
    });

    
    
    Route::controller(ItemController::class)->prefix('items')->group(function () {
        // index
        Route::get('/', 'index')->name('dashboard.items.index');

        // create
        Route::get('/create', 'create')->name('dashboard.items.create');
        Route::post('/store','store')->name('dashboard.items.store');
        // // edit
        Route::get('/edit/{item}', 'edit')->name('dashboard.items.edit');

        // // update
        Route::post('/update/{item}', 'update')->name('dashboard.items.update');

        // // delete
        Route::post('/delete/{item}', 'destroy')->name('dashboard.items.destroy');
    });
    
    Route::controller(ChildrenController::class)->prefix('children')->group(function () {
        // index
        Route::get('/', 'index')->name('dashboard.children.index');

        // create
        Route::post('/store','store')->name('dashboard.children.store');
    });
    
    Route::controller(PostController::class)->prefix('post')->group(function () {
        // index
        Route::get('/', 'index')->name('dashboard.post.index');

        // create
        Route::get('create', 'create')->name('dashboard.post.create');
        Route::post('store','store')->name('dashboard.post.store');
        // // edit
        Route::get('/edit/{post}', 'edit')->name('dashboard.post.edit');

        // // update
        Route::post('/update/post/{post}', 'update')->name('dashboard.post.update');

        // // delete
        Route::post('/delete/{post}', 'destroy')->name('dashboard.post.destroy');
    });
    
});