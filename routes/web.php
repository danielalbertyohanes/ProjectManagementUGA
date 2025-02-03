<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PptController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LogPptController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\SubTopicController;
use App\Http\Controllers\LogVideosController;
use App\Http\Controllers\LinkExternalController;

// Halaman login dan welcome tanpa middleware
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]); // Menonaktifkan registrasi


// Semua route di dalam grup ini hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {

    Route::post('/employee/store', [UserController::class, 'store'])->name('employee.store');

    // Route terkait User
    Route::get('/employee/create', [UserController::class, 'create'])->name('employee.create');
    //
    Route::post('/user/getEditForm', [UserController::class, 'getEditForm'])->name('employee.getEditForm');
    Route::put('/employee/{user}', [UserController::class, 'update'])->name('employee.update');
    Route::get('/employee/{id}', [UserController::class, 'show'])->name('employee.show');
    Route::put('/employee/{id}/change-password', [UserController::class, 'changePassword'])->name('employee.changePassword');

    // Route terkait Course
    Route::post('/course/showDataPptAndVideo/', [CourseController::class, 'showAjax'])->name('course.showAjax');
    Route::post('/course/getCreateForm', [CourseController::class, 'getCreateForm'])->name('course.getCreateForm');
    Route::post('/course/getEditForm', [CourseController::class, 'getEditForm'])->name('course.getEditForm');
    Route::put('/course/cancel/{id}', [CourseController::class, 'cancel'])->name('course.cancel');
    Route::put('/course/open/{id}', [CourseController::class, 'open'])->name('course.open');
    Route::post('/course/{course}/{action}', [CourseController::class, 'catatRecording']);
    Route::get('/course/check-button/{id}', [CourseController::class, 'checkButton'])->name('course.checkButton');

    // Route terkait Link External
    Route::post('/link_external/getEditForm', [LinkExternalController::class, 'getEditForm'])->name('link.getEditForm');

    // Route terkait Dosen
    Route::post('/dosen/getCreateForm', [DosenController::class, 'getCreateForm'])->name('dosen.getCreateForm');
    Route::post('/dosen/getEditForm', [DosenController::class, 'getEditForm'])->name('dosen.getEditForm');

    // Route terkait Periode
    Route::post('/periode/getCreateForm', [PeriodeController::class, 'getCreateForm'])->name('periode.getCreateForm');
    Route::post('/periode/getEditForm', [PeriodeController::class, 'getEditForm'])->name('periode.getEditForm');

    // Route terkait Topic dan Subtopic
    Route::post('/topic/getEditForm', [TopicController::class, 'getEditForm'])->name('topic.getEditForm');
    Route::post('/topic/getCreateForm', [TopicController::class, 'getCreateForm'])->name('topic.getCreateForm');
    Route::post('/subtopic/getEditForm', [SubTopicController::class, 'getEditForm'])->name('subtopic.getEditForm');

    // Route terkait PPT
    Route::get('/ppt/create/{sub_topic_id}', [PptController::class, 'create'])->name('ppt.newPpt');
    Route::post('/subtopic/ppt/getPptEditForm', [PptController::class, 'getPptEditForm'])->name('ppt.getPptEditForm');
    Route::post('/ppt/{ppt}/editing/{action}', [PptController::class, 'catatRecording'])->name('ppt.editing');
    Route::get('/subtopic/ppt/getLogPpt', [LogPptController::class, 'getLogPpt'])->name('logPpt.getLogPpt');
    Route::get('/logppt/check-button/{id}', [LogPptController::class, 'checkButton']);

    // Route terkait Video
    Route::get('/video/create/{sub_topic_id}', [VideoController::class, 'create'])->name('video.newVideo');
    Route::post('/subtopic/video/getVideoEditForm', [VideoController::class, 'getVideoEditForm'])->name('video.getVideoEditForm');
    Route::post('/video/{video}/recording/{action}', [VideoController::class, 'catatRecording'])->name('video.recording');
    Route::get('/subtopic/video/getLogVideo', [LogVideosController::class, 'getLogVideo'])->name('logVideo.getLogVideo');
    Route::get('/logvideo/check-button/{id}', [LogVideosController::class, 'checkButton']);

    // Resource Controllers
    Route::resource('link_external', LinkExternalController::class);
    Route::resource('video', VideoController::class);
    Route::resource('ppt', PptController::class);
    Route::resource('topic', TopicController::class);
    Route::resource('subTopic', SubTopicController::class);
    Route::resource('course', CourseController::class);
    Route::resource('dosen', DosenController::class);
    Route::resource('employee', UserController::class);
    Route::resource('periode', PeriodeController::class);
    Route::resource('logPpt', LogPptController::class);
    Route::resource('logVideo', LogVideosController::class);
    Route::resource('user', UserController::class);
    Route::resource('report', ReportController::class);

    // Dashboard setelah login
    Route::get('/home', function () {
        return view('layouts.welcome');
    })->name('welcome');
});
