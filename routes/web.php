<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // ✅ เพิ่ม
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnnounceController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipLoanController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MemberLoanController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\MemberDashboardController;

// ✅ ใช้คอนโทรลเลอร์ของ flow ลืมรหัสผ่านชุดใหม่
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('webpage');
});

Auth::routes(['reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('dashboard', [MemberDashboardController::class,'index'])->name('dashboard');

/** ✅ Forget Password (ใช้ชุดของ Laravel ตามสไตล์ Breeze/Jetstream) */
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');


Route::get('equipLoan', [EquipLoanController::class, 'indexForMember'])->name('equipLoan');
Route::post('equipLoan', [EquipLoanController::class, 'store'])->name('equipLoan.store');
Route::post('equipLoan/checkReturn', [EquipLoanController::class, 'returnItem'])->name('admin.equipLoan.return');
Route::patch('/my-loans/{loan}/request-return', [EquipLoanController::class, 'requestReturn'])->name('equipLoan.requestReturn');
Route::get('/my-history', [MemberLoanController::class, 'history'])->name('member.loans.history');

Route::middleware('role:super-admin')->group(function(){
     Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/update-role', [UserManagementController::class, 'updateRole'])->name('users.updateRole');
});

Route::middleware('role:admin')->group(function(){
    //Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('admin/dashboard',[App\Http\Controllers\DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('admin/announcements/create', [AnnounceController::class, 'create'])->name('admin.add-announce');
Route::post('admin/announcements',[AnnounceController::class,'store'])->name('admin.announce-store');
Route::get('admin/announcements/{announcement}/edit',[AnnounceController::class,'edit'])->name('admin.edit-announce');
Route::put('admin/announcements/{announcement}',[AnnounceController::class,'update'])->name('admin.update-announce');
Route::delete('admin/announcements/{id}', [AnnounceController::class, 'destroy'])
    ->name('admin.delete-announce');

Route::get('admin/equip', [EquipController::class, 'index'])->name('admin.equip');
Route::get('admin/equip/create', [EquipController::class, 'create'])->name('admin.add-equip');
Route::post('admin/equip',[EquipController::class,'store'])->name('admin.equip-store');
Route::get('admin/equip/{equip}/edit',[EquipController::class,'edit'])->name('admin.edit-equip');
Route::put('admin/equip/{equip}',[EquipController::class,'update'])->name('admin.update-equip');
Route::delete('admin/equip/{id}', [EquipController::class, 'destroy'])
    ->name('admin.delete-equip');

Route::get('admin/category', [CategoryController::class, 'index'])->name('admin.category');
Route::get('admin/category/create', [CategoryController::class, 'create'])->name('admin.add-category');
Route::post('admin/category',[CategoryController::class,'store'])->name('admin.category-store');
Route::get('admin/category/{category}/edit',[CategoryController::class,'edit'])->name('admin.edit-category');
Route::put('admin/category/{category}',[CategoryController::class,'update'])->name('admin.update-category');
Route::delete('admin/category/{id}', [CategoryController::class, 'destroy'])
    ->name('admin.delete-category');

Route::get('admin/loans/pending', [EquipLoanController::class, 'pending'])->name('admin.loans.pending');
Route::patch('/loans/{loan}/confirm-return', [EquipLoanController::class, 'confirmReturn'])->name('admin.loans.confirmReturn');
Route::get('admin/loanHistory',[EquipLoanController::class,'history'])->name('admin.loanHistory');


Route::get('admin/item', [ItemController::class, 'index'])->name('admin.item');
Route::get('admin/item/create', [ItemController::class, 'create'])->name('admin.add-item');
Route::post('admin/item',[ItemController::class,'store'])->name('admin.item-store');
Route::get('admin/item/{item}/edit',[ItemController::class,'edit'])->name('admin.edit-item');
Route::put('admin/item/{item}',[ItemController::class,'update'])->name('admin.update-item');
// ใน routes/web.php
Route::get('admin/items/edit-bulk', [ItemController::class, 'bulkEdit'])->name('admin.items.bulk-edit');
Route::put('admin/items/bulk-update', [ItemController::class, 'bulkUpdate'])->name('admin.items.bulk-update');

Route::delete('admin/item/{id}', [ItemController::class, 'destroy'])
    ->name('admin.delete-item');
});