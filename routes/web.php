<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IklanController;
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
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/register/umkm', [AuthController::class, 'reg_umkm'])->name('register_umkm')->middleware('guest');
Route::post('/register/umkm', [AuthController::class, 'ins_umkm']);
Route::get('/login', [AuthController::class, 'login_page'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/register/jobseeker', [AuthController::class, 'reg_job'])->name('register_jobseeker');
Route::post('/register/jobseeker', [AuthController::class, 'ins_jobseeker']);
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/iklan/{id_iklan}', [HomeController::class, 'detail'])->name('detail');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'editprofile']);
Route::post('/editpassword', [ProfileController::class, 'pass_view'])->name('pass_view');
Route::post('/changepassword', [ProfileController::class, 'change_pass'])->name('change_pass');
Route::post('/download', [ProfileController::class, 'cv_download'])->name('download');
Route::get('/application', [JobController::class, 'display'])->name('application')->middleware('pelamar');
Route::post('/application', [JobController::class, 'apply']);
Route::get('/inbox', [JobController::class, 'inbox'])->name('inbox')->middleware('umkm');
Route::post('/accept', [JobController::class, 'accept'])->name('accept');
Route::post('/reject', [JobController::class, 'reject'])->name('reject');
Route::get('/viewiklan', [IklanController::class, 'viewiklan'])->name('viewiklan')->middleware('umkm');
Route::get('/newiklan', [IklanController::class, 'newiklanpage'])->name('newiklanpage')->middleware('umkm');
Route::post('/newiklan/create', [IklanController::class, 'createiklan'])->name('createiklan');
Route::get('/editiklan/{id_iklan}' , [IklanController::class, 'editiklanpage'])->name('editiklanpage')->middleware('umkm');
Route::post('/updateiklan', [IklanController::class, 'updateiklan'])->name('updateiklan');
Route::get('/viewiklanadmin', [AdminController::class, 'viewalliklan'])->name('viewiklanadmin')->middleware('admin');
Route::post('/umkmsearch', [AdminController::class, 'adminUmkmSearch'])->name('adminsearch');
Route::get('/managebidang', [AdminController::class, 'adminManageBidang'])->name('managebidang')->middleware('admin');
Route::post('/addbidang', [AdminController::class, 'addBidang'])->name('addbidang');
Route::post('/deletebidang', [AdminController::class, 'deleteBidang'])->name('deletebidang');
Route::post('/deleteiklan', [AdminController::class, 'deleteiklan'])->name('deleteiklan');
