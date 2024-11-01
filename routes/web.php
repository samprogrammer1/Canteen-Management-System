<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    // Menu Route List
    Route::get('/add-menu', function () {
        return view('menu.add-menu')->with('success', 'Product added successfully!');;
    })->name('add-menu');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::post('/add/excel/products', [ProductController::class, 'excelStore'])->name('products.excelStore');

    Route::get('/menu-list', [ProductController::class, 'index'])->name('menu-list');
    Route::get('/menu-list/reload', [ProductController::class, 'reloadProductList'])->name('menu-list.reload');

    Route::get('/menu/{id}/product', [ProductController::class, 'updateForm'])->name('menu-updateForm');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('delete/excel/products', [ProductController::class, 'excelDestroy'])->name('products.excelDestroy');

    // Route::post('/buy-now/product',[ProductController::class, 'buyNow'])->name('orders.store');
    Route::post('/buy-now/product', [OrderController::class, 'storeOrder'])->name('orders.store');

    Route::get('/order-list',[OrderController::class , 'index'])->name('order-list');

    Route::get('/product-excel-action', function () {
        return view('menu.excel');
    })->name('menu.excel');
    
    Route::get('/invoice', function () {
        return view('orders.invoice');
    })->name('invoice');
    
    Route::get('/invoice/get',[OrderController::class , 'getInvoice'])->name('invoice-get');
    
    
    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');






