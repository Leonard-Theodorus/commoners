<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/register/umkm', [AuthController::class, 'reg_umkm'])->name('register_umkm');
Route::post('/register/umkm', [AuthController::class, 'ins_umkm']);
Route::get('/login', [AuthController::class, 'login_page'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register/jobseeker', [AuthController::class, 'reg_job'])->name('register_jobseeker');
Route::post('/register/jobseeker', [AuthController::class, 'ins_jobseeker']);
Route::post('/search', [HomeController::class, 'search']);
Route::post('/iklan/{id_iklan}', [HomeController::class, 'detail'])->name('detail');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::post('/profile', [ProfileController::class, 'editprofile']);
Route::get('/editpassword', [ProfileController::class, 'pass_view'])->name('pass_view');
Route::post('/changepassword', [ProfileController::class, 'change_pass'])->name('change_pass');
Route::post('/download', [ProfileController::class, 'cv_download'])->name('download');
Route::get('/application', [JobController::class, 'display'])->name('application');
Route::post('/application', [JobController::class, 'apply']);
Route::get('/inbox', [JobController::class, 'inbox'])->name('inbox');
Route::post('/accept', [JobController::class, 'accept'])->name('accept');
Route::post('/reject', [JobController::class, 'reject'])->name('reject');
