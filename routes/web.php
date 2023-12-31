<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeCategoryController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SupplierController;

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
Route::get('/', [HomeController::class, 'search'])->name('search');

Route::get('/product/{id}', [HomeController::class, 'show'])->name('produk.show');
Route::post('/product/{id}', [OrdersController::class, 'order'])->name('produk.order');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::prefix('dashboard')->group(function () {

    Route::get('/payment', [OrderDetailController::class, 'checkUserPayment'])->middleware('adminKaryawan')->name('payment.check');
    Route::get('/payment/cetak_pdf', [OrderDetailController::class, 'cetak_pdf_payment'])->middleware('adminKaryawan')->name('payment.cetak_pdf_payment');
    Route::put('/payment/{orderdetails:id}', [OrderDetailController::class, 'changeStatusPayment'])->middleware('adminKaryawan')->name('payment.change');
    Route::get('/payment/order/{orderdetails:id}', [PaymentController::class, 'show'])->middleware('adminKaryawan')->name('payment.showUser');
    Route::get('/payment/history/cetak_pdf', [OrderDetailController::class, 'cetak_pdf'])->name('payment.cetak_pdf');
    Route::get('/payment/history', [OrderDetailController::class, 'userHistory'])->name('payment.history');
    Route::get('/payment/history/{orderdetails:id}', [OrderDetailController::class, 'createUploadPembayaran'])->name('payment.createpayment');
    Route::post('/payment/history/', [OrderDetailController::class, 'uploadPembayaran'])->name('payment.uploadpayment');

    Route::resource('product', ProductController::class)->middleware('adminKaryawan');
    Route::resource('users', UserController::class)->middleware('IsAdmin');

    Route::get('/category', [CategoryController::class, 'index'])->middleware('IsAdmin')->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->middleware('IsAdmin')->name('category.create');
    Route::post('/category/create', [CategoryController::class, 'store'])->middleware('IsAdmin')->name('category.store');
    Route::delete('/category/{category:id}', [CategoryController::class, 'delete'])->middleware('IsAdmin')->name('category.destroy');

    Route::get('/supplier', [SupplierController::class, 'index'])->middleware('IsAdmin')->name('supplier.index');
    Route::get('/supplier/create', [SupplierController::class, 'create'])->middleware('IsAdmin')->name('supplier.create');
    Route::post('/supplier/create', [SupplierController::class, 'store'])->middleware('IsAdmin')->name('supplier.store');
    Route::get('/supplier/{supplier:id}', [SupplierController::class, 'edit'])->middleware('IsAdmin')->name('supplier.edit');
    Route::put('/supplier/{supplier:id}', [SupplierController::class, 'update'])->middleware('IsAdmin')->name('supplier.update');
    Route::delete('/supplier/{supplier:id}', [SupplierController::class, 'delete'])->middleware('IsAdmin')->name('supplier.destroy');
});

//* Wishlist
Route::get('/cart', [WishlistController::class, 'index'])->name('cart.index');
Route::get('/cart/total', [WishlistController::class, 'addToOrder'])->name('cart.addToOrder');
Route::post('/product', [WishlistController::class, 'addToWishlist'])->name('cart.addToWishlist');
Route::put('/cart/{wishlist:id}', [WishlistController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::delete('/cart/{wishlist:id}', [WishlistController::class, 'destroy'])->name('cart.delete');


// * Category
Route::get('/categories', [HomeCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [HomeCategoryController::class, 'show'])->name('categories.show');
