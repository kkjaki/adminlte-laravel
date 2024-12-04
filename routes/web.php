<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\GoodsReceiptController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Routes untuk User biasa
Route::get('', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::get('login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserLoginController::class, 'login']);
Route::post('logout', [UserLoginController::class, 'logout'])->name('logout');

// Routes untuk Admin
Route::get('loginkhususadmin', [LoginController::class, 'showLoginForm'])->name('loginkhususadmin');
Route::post('loginkhususadmin', [LoginController::class, 'login']);
Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/goods-receipts/dashboard', [GoodsReceiptController::class, 'dashboard'])->name('goods-receipts.dashboard');
    Route::get('/supplier/tambah_data', [App\Http\Controllers\supplierController::class, 'tambah_data']);
    Route::post('/supplier/simpan_data', [App\Http\Controllers\supplierController::class, 'simpan_data']);
    Route::get('/supplier/tampil_data', [App\Http\Controllers\supplierController::class, 'tampil_data']);
    Route::get('/supplier/edit_data/{id}', [App\Http\Controllers\supplierController::class, 'edit_data']);
    Route::post('/supplier/update_data', [App\Http\Controllers\supplierController::class, 'update_data']);
    Route::get('/supplier/hapus_data/{id}', [App\Http\Controllers\supplierController::class, 'hapus_data']);
    Route::get('/goods-receipts/index', [GoodsReceiptController::class, 'index'])->name('goods-receipts.index');
    Route::get('/goods-receipts/create', [GoodsReceiptController::class, 'create'])->name('goods-receipts.create');
    Route::post('/goods-receipts', [GoodsReceiptController::class, 'store'])->name('goods-receipts.store');
    Route::get('/goods-receipts/{id}/edit', [GoodsReceiptController::class, 'edit'])->name('goods-receipts.edit');
    Route::put('/goods-receipts/{id}', [GoodsReceiptController::class, 'update'])->name('goods-receipts.update');
    Route::delete('/goods-receipts/{id}', [GoodsReceiptController::class, 'destroy'])->name('goods-receipts.destroy');
    Route::get('/goods-receipts/dashboard', [GoodsReceiptController::class, 'dashboard'])->name('goods-receipts.dashboard');
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot', [ChatbotController::class, 'getReply'])->name('chatbot.reply');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/', [GoodsReceiptController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [GoodsReceiptController::class, 'dashboard'])->name('dashboard');
    Route::get('/supplier/tampil_data', [App\Http\Controllers\supplierController::class, 'tampil_data']);
    Route::get('/goods-receipts/index', [GoodsReceiptController::class, 'index'])->name('goods-receipts.index');
    Route::get('/goods-receipts/dashboard', [GoodsReceiptController::class, 'dashboard'])->name('goods-receipts.dashboard');
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot', [ChatbotController::class, 'getReply'])->name('chatbot.reply');
});

