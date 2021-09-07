<?php

use App\Http\Controllers\DispatcherController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyInfoController;
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
        Route::get('/syncDB', [UserController::class, 'syncDB'])->name('syncDB');
        Route::get('/products', [ProductController::class, 'index'])->name('products');
        Route::post('/products', [ProductController::class, 'get_products'])->name('get_products');
        Route::get('/product/{category}/{sub_category}', [ProductController::class, 'products_category'])->name('products_category');
        Route::get('/add/product/{category}/{sub_category}', [ProductController::class, 'create'])->name('create_product');
        Route::post('/add/product/{category}/{sub_category}', [ProductController::class, 'store'])->name('store_product');
        Route::post('/add/product/bulk/{category}/{sub_category}', [ProductController::class, 'store_bulk'])->name('store_bulk_product');
        Route::get('/edit/product/{id}/{category}/{sub_category}', [ProductController::class, 'edit'])->name('edit_product');
        Route::put('/edit/product/{id}/{category}/{sub_category}', [ProductController::class, 'update'])->name('update_product');
        Route::get('/delete/product/{id}/{category}/{sub_category}', [ProductController::class, 'destroy'])->name('destroy_product');

        // Products
        Route::get('/company_infos', [CompanyInfoController::class, 'index'])->name('company_infos');
        Route::post('/company_infos', [CompanyInfoController::class, 'get_company_infos'])->name('get_company_infos');
        Route::get('/company_info/{category}/{sub_category}', [CompanyInfoController::class, 'company_infos_category'])->name('company_infos_category');
        Route::get('/add/company_info/{category}/{sub_category}', [CompanyInfoController::class, 'create'])->name('create_company_info');
        Route::post('/add/company_info/{category}/{sub_category}', [CompanyInfoController::class, 'store'])->name('store_company_info');
        Route::get('/edit/company_info/{id}/{category}/{sub_category}', [CompanyInfoController::class, 'edit'])->name('edit_company_info');
        Route::put('/edit/company_info/{id}/{category}/{sub_category}', [CompanyInfoController::class, 'update'])->name('update_company_info');
        Route::get('/delete/company_info/{id}/{category}/{sub_category}', [CompanyInfoController::class, 'destroy'])->name('destroy_company_info');

        // Products
        Route::get('/users', [UserController::class, 'users'])->name('users');
        Route::get('/add/user', [UserController::class, 'create'])->name('create_user');
        Route::post('/add/user', [UserController::class, 'store'])->name('store_user');
        Route::get('/edit/user/{id}', [UserController::class, 'edit'])->name('edit_user');
        Route::put('/edit/user/{id}', [UserController::class, 'update'])->name('update_user');
        Route::get('/delete/user/{id}', [UserController::class, 'destroy'])->name('destroy_user');

        // Products
        Route::get('/dispatchers', [DispatcherController::class, 'index'])->name('dispatchers');
        Route::get('/add/dispatcher', [DispatcherController::class, 'create'])->name('create_dispatcher');
        Route::post('/add/dispatcher', [DispatcherController::class, 'store'])->name('store_dispatcher');
        Route::get('/edit/dispatcher/{id}', [DispatcherController::class, 'edit'])->name('edit_dispatcher');
        Route::put('/edit/dispatcher/{id}', [DispatcherController::class, 'update'])->name('update_dispatcher');
        Route::get('/delete/dispatcher/{id}', [DispatcherController::class, 'destroy'])->name('destroy_dispatcher');

        // Orders
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');

        // Sign Out
        Route::get('/logout', [UserController::class, 'logout'])->name('admin_logout');
    });
});
