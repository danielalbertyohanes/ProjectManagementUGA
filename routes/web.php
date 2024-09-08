<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DosenController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkExternalController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PptController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\SubTopicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\LogPptController;
use App\Http\Controllers\LogVideosController;

use App\Models\Ppt;

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


// routes/web.php
Route::post('course/showDataPptAndVideo/', [CourseController::class, 'showAjax'])->name('course.showAjax');

Route::post('/course/getCreateForm', [CourseController::class, 'getCreateForm'])->name('course.getCreateForm');

Route::post('/course/getEditForm', [CourseController::class, 'getEditForm'])->name('course.getEditForm');

Route::post('/link_external/getEditForm', [LinkExternalController::class, 'getEditForm'])->name('link.getEditForm');

Route::post('/dosen/getCreateForm', [DosenController::class, 'getCreateForm'])->name('dosen.getCreateForm');

Route::post('/dosen/getEditForm', [DosenController::class, 'getEditForm'])->name('dosen.getEditForm');

Route::post('/employee/getCreateForm', [UserController::class, 'getCreateForm'])->name('employee.getCreateForm');

Route::post('/periode/getCreateForm', [PeriodeController::class, 'getCreateForm'])->name('periode.getCreateForm');

Route::post('/periode/getEditForm', [PeriodeController::class, 'getEditForm'])->name('periode.getEditForm');

Route::post('topic/geEditForm', [TopicController::class, 'getEditForm'])->name('topic.getEditForm');

Route::post('subtopic/geEditForm', [SubTopicController::class,  'getEditForm'])->name('subtopic.getEditForm');

Route::post('subtopic/ppt/getPptEditForm', [PptController::class, 'getPptEditForm'])->name('ppt.getPptEditForm');

Route::post('subtopic/video/getVideoEditForm', [VideoController::class, 'getVideoEditForm'])->name('video.getVideoEditForm');

Route::post('subtopic/ppt/getLogPptForm', [LogPptController::class, 'getLogPptForm'])->name('logPpt.getLogPptForm');

Route::Post('subtopic/video/getLogVideoForm', [LogVideosController::class, 'getLogVideoForm'])->name('logVideo.getLogVideoForm');

Route::post('subtopic/ppt/getPptEditForm', [PptController::class, 'getPptEditForm'])->name('ppt.getPptEditForm');

Route::post('subtopic/video/getVideoEditForm', [VideoController::class, 'getVideoEditForm'])->name('video.getVideoEditForm');
// Route::post('/topic/get-edit-form', [TopicController::class, 'getEditForm'])->name('topic.getEditForm');





// Route::put('/topic/update/{id}', [TopicController::class, 'update'])->name('topic.update');




Route::get('/welcome', function () {
    return view('layouts.welcome');
})->name('welcome');


Route::get('/topic/create/{course_id}', [TopicController::class, 'create'])->name('topic.newtopic');

Route::get('/ppt/create/{sub_topic_id}', [PptController::class, 'create'])->name('ppt.newPpt');

Route::get('/video/create/{sub_topic_id}', [VideoController::class, 'create'])->name('video.newVideo');

Route::get('/video/create/{sub_topic_id}', [VideoController::class, 'create'])->name('video.newVideo');


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('link_external', LinkExternalController::class);
Route::resource('video', VideoController::class);
Route::resource('ppt', PptController::class);
Route::resource('topic', TopicController::class);
Route::resource('subTopic', SubTopicController::class);
Route::resource('course', CourseController::class);
Route::resource('dosen', DosenController::class);
Route::resource('employee',  UserController::class);
Route::resource('periode',  PeriodeController::class);
Route::resource('logPpt', LogPptController::class);
Route::resource('logVideo', LogVideosController::class);
