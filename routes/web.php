<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AdminSignIn;
use App\Http\Middleware\AdminSignOut;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [UserController::class, 'index']);
Route::get('/company/info', [UserController::class, 'companyInfo']);

// Admin
Route::group(['prefix' => 'admin'], function (){
    Route::middleware([AdminSignOut::class])->group(function () {
        Route::get('/login', [UserController::class, 'login'])->name('login');
        Route::post('/login', [UserController::class, 'submit_Login']);
    });
    
    Route::middleware([AdminSignIn::class])->group(function () {
        // Dashboard
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin_dashboard');

        // Products
        Route::get('/products', [ProductController::class, 'index'])->name('products');
        Route::post('/products', [ProductController::class, 'get_products'])->name('get_products');
        Route::get('/product/{category}/{sub_category}', [ProductController::class, 'products_category'])->name('products_category');
        Route::get('/add/product/{category}/{sub_category}', [ProductController::class, 'create'])->name('create_product');
        Route::post('/add/product/{category}/{sub_category}', [ProductController::class, 'store'])->name('store_product');
        Route::get('/edit/product/{id}/{category}/{sub_category}', [ProductController::class, 'edit'])->name('edit_product');
        Route::put('/edit/product/{id}/{category}/{sub_category}', [ProductController::class, 'update'])->name('update_product');
        Route::get('/delete/product/{id}/{category}/{sub_category}', [ProductController::class, 'destroy'])->name('destroy_product');

        // Products
        Route::get('/users', [UserController::class, 'users'])->name('users');
        Route::get('/add/user', [UserController::class, 'create'])->name('create_user');
        Route::post('/add/user', [UserController::class, 'store'])->name('store_user');
        Route::get('/edit/user/{id}', [UserController::class, 'edit'])->name('edit_user');
        Route::put('/edit/user/{id}', [UserController::class, 'update'])->name('update_user');
        Route::get('/delete/user/{id}', [UserController::class, 'destroy'])->name('destroy_user');

        // Sign Out
        Route::get('/logout', [UserController::class, 'logout'])->name('admin_logout');
    });
});
