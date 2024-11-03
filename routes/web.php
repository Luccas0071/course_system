<?php

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
    return redirect('/login');
});

Route::view('/login',           'login');

Route::view('/student',         'student/course');

Route::view('/admin',           'admin/course')->name('admin.index');
Route::view('/admin/course',    'admin/course')->name('admin.course');
Route::view('/admin/report',    'admin/report')->name('admin.report');
Route::view('/admin/user',      'admin/user')->name('admin.user');
