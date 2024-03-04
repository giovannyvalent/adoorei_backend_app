<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::controller(SalesController::class)
    ->prefix('sales')
    ->group( function(){
    Route::get('/all', 'all')->name('sales.all');
    Route::get('/all-closeds', 'allCloseds')->name('sales.allCloseds');
    Route::get('/{id}', 'showSale')->name('sales.showSale');
    Route::get('/store/{id}', 'listSalesByStore')->name('sales.listSalesByStore');
    Route::post('/register', 'salesUnique')->name('sales.salesUnique');
    Route::post('/register-batch', 'salesBatch')->name('sales.salesBatch');
    Route::put('/update-sales', 'updateSales')->name('sales.updateSales');
    Route::put('/cancel-sales', 'cancelSales')->name('sales.cancelSales');
    Route::get('/closeds', 'closeds')->name('sales.closeds');
});


Route::controller(ProductsController::class)
    ->prefix('products')
    ->group( function(){
    Route::get('/all', 'all')->name('products.all');
});





