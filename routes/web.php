<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RamenController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffOrderController;
use Illuminate\Auth\Events\Login;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.newlogin');
});

Auth::routes();

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/login', [LoginController::class, 'login'])->name('newlogin');

// route admin
Route::middleware(['auth', 'user-role:admin'])->group(function (){
    Route::get('/adminHome', [AdminController::class, 'adminHome'])->name('home.admin');
    Route::get('/cust', [AdminController::class, 'customerData'])->name('home.admin.cust');
    Route::get('/admin/register', [AdminController::class, 'register'])->name('register.admin');
    Route::post('/admin/regis', [AdminController::class, 'addProfile'])->name('add.admin');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('profile.admin');
    Route::post('/admin/update/{id}', [AdminController::class, 'updateProfile'])->name('updateProfile.admin');
    Route::get('/admin/deleteStaff/{id}', [AdminController::class, 'deleteStaff'])->name('deleteStaff.admin');
    Route::get('/adminHistory', [AdminOrderController::class, 'showHistory'])->name('history.admin');
    Route::get('/pdf/{id}', [AdminController::class, 'showPDF'])->name('showPDF.admin');
    Route::prefix('/adminQueue')->group(function () {
        Route::get('/', [AdminOrderController::class, 'showQueue'])->name('showQueue.admin');
        Route::get('/handle/{id}', [AdminOrderController::class, 'handleOrder'])->name('handleOrder.admin');
        Route::get('/remove/{id}', [AdminOrderController::class, 'removeOrder'])->name('removeOrder.admin');
        Route::get('/detail/{id}', [AdminOrderController::class, 'showDetail'])->name('showDetail.admin');
        Route::get('/removeDetail/{id}', [AdminOrderController::class, 'removeDetail'])->name('removeDetail.admin');
    });
    Route::prefix('/raamen')->group(function () {
        Route::get('/', [AdminController::class, 'showRamen'])->name('showRamen.admin');
        Route::get('/create', [AdminController::class, 'createRamen'])->name('createRamen.admin');
        Route::get('/edit/{id}', [AdminController::class, 'editRamen'])->name('editRamen.admin');
        Route::get('/delete/{id}', [AdminController::class, 'deleteRamen'])->name('deleteRamen.admin');
        Route::post('/store', [AdminController::class, 'storeRamen'])->name('storeRamen.admin');
        Route::post('/update/{id}', [AdminController::class, 'updateRamen'])->name('updateRamen.admin');
    });
});

// route member
Route::middleware(['auth', 'user-role:member'])->group(function (){
    Route::get('/memberHome', [CustomerController::class, 'customerHome'])->name('home.member');
    Route::get('/member/profile', [CustomerController::class, 'custProfile'])->name('custProfile');
    Route::get('/member/cart', [CustomerController::class, 'custCart'])->name('cart.customer');
    Route::get('/custHistory/{id}', [CustomerController::class, 'showHistory'])->name('history.member');
    Route::get('/historyDetail/{id}', [CustomerController::class, 'showDetail'])->name('detail.member');
    Route::post('/member/update/{id}', [CustomerController::class, 'custUpdateProfile'])->name('custUpdateProfile');
    Route::prefix('/cart')->group(function () {
        Route::get('/', [CartController::class, 'showCart'])->name('showCart.member');
        Route::post('/store/{id}', [CartController::class, 'storeCart'])->name('storeCart.member');
        Route::post('/remove/{id}', [CartController::class, 'removeCart'])->name('removeCart.member');
        Route::post('/submit', [CartController::class, 'submitCart'])->name('submitCart.member');
    });
});

// route staff
Route::middleware(['auth', 'user-role:staff'])->group(function (){
    Route::get('/staffHome', [StaffController::class, 'staffHome'])->name('home.staff');
    Route::get('/staff/profile', [StaffController::class, 'staffProfile'])->name('staffProfile');
    Route::post('/staff/update/{id}', [StaffController::class, 'staffUpdateProfile'])->name('staffUpdateProfile');
    Route::prefix('/ramen')->group(function () {
        Route::get('/', [RamenController::class, 'showRamen'])->name('showRamen');
        Route::get('/create', [RamenController::class, 'createRamen'])->name('createRamen');
        Route::get('/edit/{id}', [RamenController::class, 'editRamen'])->name('editRamen');
        Route::get('/delete/{id}', [RamenController::class, 'deleteRamen'])->name('deleteRamen');
        Route::post('/store', [RamenController::class, 'storeRamen'])->name('storeRamen');
        Route::post('/update/{id}', [RamenController::class, 'updateRamen'])->name('updateRamen');
    });
    Route::prefix('/staffQueue')->group(function () {
        Route::get('/', [StaffOrderController::class, 'showQueue'])->name('showQueue.staff');
        Route::get('/staffHandle/{id}', [StaffOrderController::class, 'handleOrder'])->name('handleOrder.staff');
        Route::get('/staffRemove/{id}', [StaffOrderController::class, 'removeOrder'])->name('removeOrder.staff');
        Route::get('/staffDetail/{id}', [StaffOrderController::class, 'showDetail'])->name('showDetail.staff');
    });
});