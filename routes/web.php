<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CatagoryController;
use App\Http\Controllers\Backend\ProductController;


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



// Route::get('/admin/dash', function () {
//     return view('backend.dashboard.index');
// });



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login-check', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::prefix('admin')->middleware(['auth'])->group(function () {

    // ====================   dashboard
    Route::get('/dash', [AuthController::class, 'showDashboard'])->name('dashboard');







    // ========================user

    // user page
    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    Route::get('/user-add', [UserController::class, 'add'])->name('user.add');

    Route::post('/user-save', [UserController::class, 'save'])->name('user.save');

    Route::get('/user-delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('user.edit');

    Route::post('/user-update/{id}', [UserController::class, 'update'])->name('user.update');

    // Category Routes

    Route::get('/catagory', [CatagoryController::class, 'index'])->name('catagory.index');

    Route::get('/catagory-add', [CatagoryController::class, 'add'])->name('catagory.add');

    Route::post('/catagory-save', [CatagoryController::class, 'save'])->name('catagory.save');

    Route::get('/catagory-delete/{id}', [CatagoryController::class, 'delete'])->name('catagory.delete');

    Route::get('/catagory-edit/{id}', [CatagoryController::class, 'edit'])->name('catagory.edit');

    Route::post('/catagory-update/{id}', [CatagoryController::class, 'update'])->name('catagory.update');

    // brand Page

    Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');

    Route::get('/brand-add', [BrandController::class, 'add'])->name('brand.add');

    Route::post('/brand-save', [BrandController::class, 'save'])->name('brand.save');

    Route::get('/brand-delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');

    Route::get('/brand-view/{id}', [BrandController::class, 'view'])->name('brand.view');

    Route::get('/brand-edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');

    Route::post('/update-brand-image/{id}', [BrandController::class, 'updateBrandImage'])->name('updateBrandImage');

    Route::post('/brand-update/{id}', [BrandController::class, 'update'])->name('brand.update');

    Route::get('/brand-member/{id}', [BrandController::class, 'member'])->name('brand.member');

    Route::get('/member-add/{id}', [BrandController::class, 'addMember'])->name('member.add');

    Route::post('/member-save', [BrandController::class, 'saveMember'])->name('member.save');

    Route::get('/member-edit/{id}', [BrandController::class, 'editMember'])->name('member.edit');

    Route::post('/member-update/{id}', [BrandController::class, 'updateMember'])->name('member.update');

    Route::get('/member-delete/{id}', [BrandController::class, 'deleteMember'])->name('member.delete');


    //product page

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');

    Route::get('/product-add', [ProductController::class, 'add'])->name('product.add');

    Route::post('/product-save', [ProductController::class, 'save'])->name('product.save');

    Route::post('/product-update/{id}', [ProductController::class, 'update'])->name('product.update');

    Route::get('/product-delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    Route::get('/product-view/{id}', [ProductController::class, 'view'])->name('product.view');

    Route::get('/product-edit/{id}', [ProductController::class, 'edit'])->name('product.edit');


});
