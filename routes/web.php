<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\userMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

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




// Get login /register
Route::middleware(['admin_auth'])->group(function () {

    Route::redirect('/','loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('Page',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

//Authentication Route
Route::middleware([ 'auth'])->group(function () {
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('auth#dashboard');
    // admin route
    Route::middleware(['admin_auth'])->group(function () {

        Route::group(['prefix'=>'category'],function(){
            Route::get('/list', [CategoryController::class,'list'])->name('category#list');
            Route::get('/create/page', [CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update/{id}',[CategoryController::class,'update'])->name('category#update');
        });
        // admin
        Route::prefix('admin')->group(function () {
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/changePasswrod',[AdminController::class,'changePassword'])->name('admin#changePassword');
            //account info
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            //Update the acouunt page
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            // update the account
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');
            // list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            // delete users
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            // delete users
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#adminChangeRole');
            Route::get('updateRole',[AdminController::class,'updateRole'])->name('admin#updateRole');
            Route::get('contacts',[AdminController::class,'contacts'])->name('admin#contacts');

        });
        // product
        Route::prefix('products')->group(function () {
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('delete,{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('edit,{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::get('updatePage,{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
            Route::post('update,{id}',[ProductController::class,'update'])->name('product#update');


        });
        // product
        Route::prefix('order')->group(function () {
            Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
            Route::get('change/status',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
            Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');
            Route::get('listInfo,{orderCode}',[OrderController::class,'listInfo'])->name('admin#listInfo');



        });
        //
        Route::prefix('user')->group(function () {
            Route::get('list',[UserController::class,'userList'])->name('admin#userList');
            Route::get('change/role',[UserController::class,'changeRole'])->name('admin#changeRole');
            Route::get('account/delete/{id}',[UserController::class,'deleteAccount'])->name('admin#deleteAccount');




        });


    });
    // user route
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){

        Route::get('/homePage',[UserController::class,'home'])->name('user#home');
        Route::get('/filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('/history',[UserController::class,'history'])->name('user#history');
        Route::get('/contact',[UserController::class,'contactPage'])->name('user#contactPage');
        Route::post('/sendMessage',[UserController::class,'sendMessage'])->name('user#sendMessage');

        //
        Route::prefix('pizza')->group(function () {
            Route::get('details/{id}',[userController::class,'pizzaDetails'])->name('user#pizzaDetails');
        });
        //
        Route::prefix('cart')->group(function () {
            Route::get('cartList',[userController::class,'cartList'])->name('user#cartList');
        });
        //
        Route::prefix('password')->group(function () {
            Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');
        });
        //
        Route::prefix('account')->group(function () {
            Route::get('change',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
            Route::post('change,{id}',[UserController::class,'accountChange'])->name('user#accountChange');

        });
        // Ajax
        Route::prefix('ajax')->group(function () {
            Route::get('pizzaList',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('addSingleItem',[AjaxController::class,'addSingleItem'])->name('ajax#addSingleItem');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            Route::get('clear/current/product',[AjaxController::class,'clearCurrentProduct'])->name('ajax#clearCurrentProduct');
            Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
        });
    });

});
