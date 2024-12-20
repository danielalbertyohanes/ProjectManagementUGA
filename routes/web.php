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


// routes/web.php


Route::post('/user/getEditForm', [UserController::class, 'getEditForm'])->name('employee.getEditForm');
Route::put('/employee/{user}', [UserController::class, 'update'])->name('employee.update');

Route::get('/employee/{id}', [UserController::class, 'show'])->name('employee.show');

Route::post('/course/showDataPptAndVideo/', [CourseController::class, 'showAjax'])->name('course.showAjax');

Route::post('/course/getCreateForm', [CourseController::class, 'getCreateForm'])->name('course.getCreateForm');

Route::post('/course/getEditForm', [CourseController::class, 'getEditForm'])->name('course.getEditForm');

Route::post('/link_external/getEditForm', [LinkExternalController::class, 'getEditForm'])->name('link.getEditForm');

Route::post('/dosen/getCreateForm', [DosenController::class, 'getCreateForm'])->name('dosen.getCreateForm');

Route::post('/dosen/getEditForm', [DosenController::class, 'getEditForm'])->name('dosen.getEditForm');

Route::post('/periode/getCreateForm', [PeriodeController::class, 'getCreateForm'])->name('periode.getCreateForm');

Route::post('/periode/getEditForm', [PeriodeController::class, 'getEditForm'])->name('periode.getEditForm');

Route::post('/topic/getEditForm', [TopicController::class, 'getEditForm'])->name('topic.getEditForm');

Route::post('/topic/getCreateForm', [TopicController::class, 'getCreateForm'])->name('topic.getCreateForm');

Route::post('/subtopic/getEditForm', [SubTopicController::class, 'getEditForm'])->name('subtopic.getEditForm');

Route::post('/subtopic/ppt/getPptEditForm', [PptController::class, 'getPptEditForm'])->name('ppt.getPptEditForm');

Route::post('/subtopic/video/getVideoEditForm', [VideoController::class, 'getVideoEditForm'])->name('video.getVideoEditForm');

Route::get('/subtopic/ppt/getLogPpt', [LogPptController::class, 'getLogPpt'])->name('logPpt.getLogPpt');

Route::get('/subtopic/video/getLogVideo', [LogVideosController::class, 'getLogVideo'])->name('logVideo.getLogVideo');

Route::post('/subtopic/ppt/getPptEditForm', [PptController::class, 'getPptEditForm'])->name('ppt.getPptEditForm');

Route::post('subtopic/video/getVideoEditForm', [VideoController::class, 'getVideoEditForm'])->name('video.getVideoEditForm');

Route::get('/ppt/create/{sub_topic_id}', [PptController::class, 'create'])->name('ppt.newPpt');

Route::get('/video/create/{sub_topic_id}', [VideoController::class, 'create'])->name('video.newVideo');

Route::post('/video/{video}/recording/{action}', [VideoController::class, 'catatRecording'])
    ->name('video.recording');

Route::post('/video/check-button/{id}', [VideoController::class, 'checkFinishStatus']);

Route::post('/ppt/{ppt}/editing/{action}', [PptController::class, 'catatRecording'])
    ->name('ppt.editing');

Route::post('/ppt/check-button/{id}', [PptController::class, 'checkFinishStatus']);


Route::post('/course/{course}/{action}', [CourseController::class, 'catatRecording']);
Route::get('/course/check-button/{id}', [CourseController::class, 'checkButton'])->name('course.checkButton');







Route::get('/welcome', function () {
    return view('layouts.welcome');
})->name('welcome');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


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
