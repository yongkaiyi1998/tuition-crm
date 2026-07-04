<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Route::get('/register', [AuthController::class, 'signup']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authentication']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('students', StudentController::class)->except(['show']);
    Route::resource('courses', CourseController::class)->except(['show']);
    Route::resource('enrollments', EnrollmentController::class)->except(['show']);
    Route::resource('invoices', InvoiceController::class)->except(['show']);
    Route::resource('payments', PaymentController::class)->except(['show']);

    Route::middleware('admin')->group(function () {

        Route::resource('users', UserController::class)->except(['show']);
        Route::put('/users/{user}/reset-password', [UserController::class, 'resetPassword']) ->name('users.reset-password');
        Route::resource('settings', SettingController::class)->only(['index', 'store']);
    });

});