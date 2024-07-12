<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DosenController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


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
//TEST INI BUSI COBA GITHUB

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// routes/web.php

Route::resource('course', CourseController::class);
Route::post('/course/getEditForm', [CourseController::class, 'getEditForm'])->name('course.getEditForm');

Route::resource('dosen', DosenController::class);
Route::get('/welcome', function () {
    return view('layouts.welcome');
})->name('welcome');


Route::get('/home', [HomeController::class, 'index'])->name('home');
