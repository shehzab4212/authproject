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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth:users')->group(function () {
Route::get('/home', 'HomeController@index')->name('home');
});
Route::prefix('admin')->group(function () {
Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.loginview');
Route::post('/login', 'Admin\Auth\LoginController@login')->name('admin.login');
Route::get('/register', 'Admin\Auth\RegisterController@showRegisterForm')->name('admin.registerview');
Route::post('/register', 'Admin\Auth\RegisterController@register')->name('admin.register');

Route::middleware('auth:admins')->group(function () {
Route::get('/dashboard', 'Admin\HomeController@index')->name('admin.dashboard');
});
});
