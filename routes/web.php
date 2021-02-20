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
        Route::get('/add/product', [ProductController::class, 'create'])->name('create_product');
        Route::post('/add/product', [ProductController::class, 'store'])->name('store_product');
        Route::get('/edit/product/{product}', [ProductController::class, 'edit'])->name('edit_product');
        Route::put('/edit/product/{product}', [ProductController::class, 'update'])->name('update_product');
        Route::get('/delete/product/{product}', [ProductController::class, 'destroy'])->name('destroy_product');

        // Sign Out
        Route::get('/logout', [UserController::class, 'logout'])->name('admin_logout');
    });
});