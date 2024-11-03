<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login',       [AuthController::class, 'login'])->name('auth.login');

Route::middleware('auth:api')->group(function () {
    Route::get('/authenticated', function () {
        return auth()->user();
    });

    Route::get('/logout',                       [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/course',                       [CourseController::class, 'index'])->name('course.index');
    Route::get('/course/{id}',                  [CourseController::class, 'read'])->name('course.read');

    Route::get('/module/{id}',                  [ModuleController::class, 'read'])->name('module.read');

    Route::get('/content',                      [ContentController::class, 'index'])->name('content.index');
    Route::get('/content/{id}',                 [ContentController::class, 'read'])->name('content.read');
    Route::get('/content/alterSituation/{id}',  [ContentController::class, 'alterSituation'])->name('content.alterSituation');

    Route::get('/user',                         [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}',                    [UserController::class, 'read'])->name('user.read');

    Route::middleware('admin')->group(function () {
        Route::post('/course/create',           [CourseController::class, 'create'])->name('course.create');
        Route::put('/course/update',            [CourseController::class, 'update'])->name('course.update');
        Route::delete('/course/delete/{id}',    [CourseController::class, 'delete'])->name('course.delete');

        Route::post('/module/create',           [ModuleController::class, 'create'])->name('module.create');
        Route::put('/module/update',            [ModuleController::class, 'update'])->name('module.update');
        Route::delete('/module/delete/{id}',    [ModuleController::class, 'delete'])->name('module.delete');

        Route::post('/content/create',          [ContentController::class, 'create'])->name('content.create');
        Route::put('/content/update',           [ContentController::class, 'update'])->name('content.update');
        Route::delete('/content/delete/{id}',   [ContentController::class, 'delete'])->name('content.delete');
        Route::get('/content/usersViewed/{id}', [ContentController::class, 'usersViewed'])->name('content.usersViewed');

        Route::post('/user/create',             [UserController::class, 'create'])->name('user.create');
        Route::put('/user/update',              [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/delete/{id}',      [UserController::class, 'delete'])->name('user.delete');
        
        Route::get('/reportA',                 [ReportController::class, 'reportA'])->name('report.reportA');
        Route::get('/reportB',                 [ReportController::class, 'reportB'])->name('report.reportB');
        Route::get('/reportC',                 [ReportController::class, 'reportC'])->name('report.reportC');
        Route::get('/reportD',                 [ReportController::class, 'reportD'])->name('report.reportD');
    });
});
