<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\Backend\UserController;

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


    // brand Page

    Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');

    Route::get('/brand-add', [BrandController::class, 'add'])->name('brand.add');

    Route::post('/brand-save', [BrandController::class, 'save'])->name('brand.save');

    Route::get('/brand-delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');

    Route::get('/brand-edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');

    Route::post('/brand-update/{id}', [BrandController::class, 'update'])->name('brand.update');

});
