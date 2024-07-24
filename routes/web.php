<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DosenController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkExternalController;
use App\Http\Controllers\PptController;
use App\Http\Controllers\VideoController;

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
    return view('auth.login');
});

Auth::routes();

Route::resource('link_external', LinkExternalController::class);
Route::resource('video', VideoController::class);
Route::resource('ppt', PptController::class);
Route::resource('course', CourseController::class);
Route::resource('dosen', DosenController::class);

// routes/web.php
Route::post('course/showDataPptAndVideo/', [CourseController::class, 'showAjax'])->name('course.showAjax');

Route::post('/course/getCreateForm', [CourseController::class, 'getCreateForm'])->name('course.getCreateForm');

Route::post('/course/getEditForm', [CourseController::class, 'getEditForm'])->name('course.getEditForm');

Route::post('/link_external/getEditForm', [LinkExternalController::class, 'getEditForm'])->name('link.getEditForm');

Route::post('/dosen/getCreateForm', [DosenController::class, 'getCreateForm'])->name('dosen.getCreateForm');

Route::post('/dosen/getEditForm', [DosenController::class, 'getEditForm'])->name('dosen.getEditForm');

Route::get('/welcome', function () {
    return view('layouts.welcome');
})->name('welcome');


Route::get('/home', [HomeController::class, 'index'])->name('home');
