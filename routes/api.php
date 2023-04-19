<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

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
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('user/list',[RouteController::class,'userList']);
Route::get('cart/list',[RouteController::class,'cartList']);
Route::get('order/list',[RouteController::class,'orderList']);
Route::get('orders/list',[RouteController::class,'ordersList']);
Route::get('contact/list',[RouteController::class,'contactList']);
// post
Route::post('contact/create',[RouteController::class,'createContact']);
// Route::post('category/delete',[RouteController::class,'deleteCategory']);
Route::get('category/delete/{id}',[RouteController::class,'deleteCategory']);
// get  single category by id
Route::get('category/list/{id}',[RouteController::class,'categoryListById']);
// update
Route::post('category/update',[RouteController::class,'updateCategory']);

