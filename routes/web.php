<?php

use App\Http\Controllers\API\V1\AuthController;
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

/** Đăng kí **/
Route::get('/', function () {
    return view('welcome');
});
Route::post('/registration', [AuthController::class, 'register'])->name('user.registration');


/** Đăng nhập **/
Route::get('/login', function () {
    return view('web.login')->name('auth.login');
});
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/login', [AuthController::class, 'viewlogin'])->name('auth.login');


Route::get('/error', function () {
    return view('web.404');
});
