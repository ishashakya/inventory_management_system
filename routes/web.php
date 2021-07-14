<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\TransactionDetailsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\SalesDetailController;
use App\Http\Controllers\Admin\TransactionController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[RegisterController::class,'register'])->name('admin.register.view');
Route::post('/submit/register',[RegisterController::class,'submitRegister'])->name('admin.register.submit');
Route::get('/login',[RegisterController::class,'viewLogin'])->name('admin.login.view');
Route::post('/login/submit',[RegisterController::class,'submitLogin'])->name('admin.login.submit');

Route::group(['middleware'=>'auth'],function(){
    //Dashbaord
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('admin.includes.dashboard');
    Route::get('/profile',[DashboardController::class,'profile'])->name('admin.profile');
    Route::post('/profile/edit',[DashboardController::class,'editProfile'])->name('admin.edit.profile');
    Route::post('/profile/change/password',[DashboardController::class,'changePassword'])->name('admin.change.password');
    Route::get('/logout',[DashboardController::class,'logout'])->name('admin.logout');
    // Category
    Route::get('/category/index',[CategoryController::class,'index'])->name('admin.category.index');
    Route::get('/category/create',[CategoryController::class,'create'])->name('admin.category.create');
    Route::post('/category/store',[CategoryController::class,'store'])->name('admin.category.store');
    Route::get('/category/edit/{slug}',[CategoryController::class,'edit'])->name('admin.category.edit');
    Route::patch('/category/update/{id}',[CategoryController::class,'update'])->name('admin.category.update');
    Route::get('/category/delete/{id}',[CategoryController::class,'destroy'])->name('admin.category.delete');
    // Product
    Route::get('/product/index',[ProductController::class,'index'])->name('admin.product.index');
    Route::get('/product/create',[ProductController::class,'create'])->name('admin.product.create');
    Route::post('/product/store',[ProductController::class,'store'])->name('admin.product.store');
    Route::get('/product/delete/{product}',[ProductController::class,'destroy'])->name('admin.product.destroy');
    Route::get('/product/edit/{product}',[ProductController::class,'edit'])->name('admin.product.edit');
    Route::patch('/product/update/{product}',[ProductController::class,'update'])->name('admin.product.update');
    // Transaction
    Route::get('/transaction/index',[TransactionController::class,'index'])->name('admin.transaction.index');
    Route::get('/transaction/create',[TransactionController::class,'create'])->name('admin.transaction.create');
    Route::post('/transaction/store',[TransactionController::class,'store'])->name('admin.transaction.store');
    Route::get('/transaction/delete/{transaction}',[TransactionController::class,'destroy'])->name('admin.transaction.destroy');
    Route::get('/transaction/edit/{transaction}',[TransactionController::class,'edit'])->name('admin.transaction.edit');
    Route::patch('/transaction/update/{transaction}',[TransactionController::class,'update'])->name('admin.transaction.update');

    // Transaction Details
    Route::get('/transactiondetails/view/{id}',[TransactionDetailsController::class,'view'])->name('admin.transactionDetails.view_detail');
    // Route::get('/transactiondetails/edit/{transactionDetails}',[TransactionDetailsController::class,'edit'])->name('admin.transactionDetails.edit');
    Route::patch('/transactiondetails/update/{transactionDetails}',[TransactionDetailsController::class,'update'])->name('admin.transactionDetails.update_detail');
    Route::get('/transactiondetails/delete/{id}',[TransactionDetailsController::class,'destroy'])->name('admin.transactionDetails.destroy');
    // Inventories
    Route::get('/inventories/index',[InventoryController::class,'index'])->name('admin.inventories.index');

    // Sales
    Route::get('/sales/create',[SalesController::class,'create'])->name('admin.sale.create');
    Route::post('/sales/store',[SalesController::class,'store'])->name('admin.sale.store');
    Route::get('/sales/index',[SalesController::class,'index'])->name('admin.sale.index');
    Route::get('/sales/edit/{transaction}',[TransactionController::class,'edit'])->name('admin.sale.edit');
    Route::get('/sales/delete/{transaction}',[TransactionController::class,'destroy'])->name('admin.sale.destroy');

    // Sale Details
    Route::get('/saledetails/view/{id}',[SalesDetailController::class,'view'])->name('admin.saleDetails.sale_detail');
    Route::patch('/saledetails/update/{saleDetails}',[SalesDetailController::class,'update'])->name('admin.saleDetails.update_detail');
    Route::get('/saledetails/delete/{id}',[SalesDetailController::class,'destroy'])->name('admin.saleDetails.destroy');

    // Api
    Route::get('/api/inventories/getdata/{product_id}',[InventoryController::class,'get_data'])->name('admin.inventories.getdata');


});
