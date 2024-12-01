<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\GoodsReceiptController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/orangdalam', function () {
//     return redirect()->route('login');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Routes untuk Admin
Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'login']);
Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Routes untuk User biasa
Route::get('/', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserLoginController::class, 'login']);
Route::post('logout', [UserLoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/goods-receipts/dashboard', [GoodsReceiptController::class, 'dashboard'])->name('goods-receipts.dashboard');
    // Route admin lainnya
    Route::get('/supplier/tambah_data', [App\Http\Controllers\supplierController::class, 'tambah_data']);
    
    //route simpan data
    Route::post('/supplier/simpan_data', [App\Http\Controllers\supplierController::class, 'simpan_data']);
    
    //route tampil data
    Route::get('/supplier/tampil_data', [App\Http\Controllers\supplierController::class, 'tampil_data']);
    
    //route edit data
    Route::get('/supplier/edit_data/{id}', [App\Http\Controllers\supplierController::class, 'edit_data']);
    
    //update data
    Route::post('/supplier/update_data', [App\Http\Controllers\supplierController::class, 'update_data']);
    
    //hapus data
    Route::get('/supplier/hapus_data/{id}', [App\Http\Controllers\supplierController::class, 'hapus_data']);
    
    // Display a list of goods receipts
    Route::get('/goods-receipts/index', [GoodsReceiptController::class, 'index'])->name('goods-receipts.index');
    
    // Show the form to create a new goods receipt
    Route::get('/goods-receipts/create', [GoodsReceiptController::class, 'create'])->name('goods-receipts.create');
    
    // Store a newly created goods receipt
    Route::post('/goods-receipts', [GoodsReceiptController::class, 'store'])->name('goods-receipts.store');
    
    // Show the form to edit an existing goods receipt
    Route::get('/goods-receipts/{id}/edit', [GoodsReceiptController::class, 'edit'])->name('goods-receipts.edit');
    
    // Update an existing goods receipt
    Route::put('/goods-receipts/{id}', [GoodsReceiptController::class, 'update'])->name('goods-receipts.update');
    
    // Delete a goods receipt
    Route::delete('/goods-receipts/{id}', [GoodsReceiptController::class, 'destroy'])->name('goods-receipts.destroy');
    
    // Display the dashboard
    Route::get('/goods-receipts/dashboard', [GoodsReceiptController::class, 'dashboard'])->name('goods-receipts.dashboard');
});

//route tambah data
