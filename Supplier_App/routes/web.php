<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;


Route::get('list-supplier',[SupplierController::class,'listSupplier'])->name('listSupplier');

Route::post('add-supplier',[SupplierController::class,'addSupplier'])->name('addSupplier');

Route::get('list-item',[SupplierController::class,'listItem'])->name('listItem');

Route::post('add-item',[SupplierController::class,'addItem'])->name('addItem');

Route::post('item-buy',[SupplierController::class,'itemBuy'])->name('itemBuy');

Route::post('get-item-purchase-details',[SupplierController::class,'getItemPurchaseDetails'])->name('getItemPurchaseDetails');

Route::get('/',[SupplierController::class,'listPurchaseOrder'])->name('listPurchaseOrder');
