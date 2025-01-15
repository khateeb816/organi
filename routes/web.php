<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
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



});
