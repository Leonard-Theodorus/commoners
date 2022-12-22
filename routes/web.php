<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('guestPages.home');
})->name('home');
Route::get('/register/umkm', [AuthController::class, 'reg_umkm'])->name('register_umkm');
Route::post('/register/umkm', [AuthController::class, 'ins_umkm']);
Route::get('/login', [AuthController::class, 'login_page'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register/jobseeker', [AuthController::class, 'reg_job'])->name('register_jobseeker');
Route::post('/register/jobseeker', [AuthController::class, 'ins_jobseeker']);
