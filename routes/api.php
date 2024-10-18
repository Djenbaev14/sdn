<?php

use App\Http\Controllers\Api\ChildrenController;
use App\Http\Controllers\ItemChildrenController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::group(['prefix'=>'items'], function(){
//     Route::get('/', [ItemController::class, 'index'])->name('items.index');
// });

Route::apiResource('menus',\App\Http\Controllers\Api\MenuController::class);

// Route::apiResource('menu-items',MenuItemController::class);
Route::apiResource('childrens',ChildrenController::class);
Route::get('/{slug}',[ChildrenController::class,'blog']);
Route::get('/{item_slug}/{post_slug}',[ChildrenController::class,'show_post']);

