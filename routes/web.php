<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

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

Route::get('/registration-form', [AuthController::class, 'registrationForm'])->name('registrationForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login-form', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/fill-email-password-reset', [AuthController::class, 'fillEmailPasswordReset'])->name('fillEmailPasswordReset');
Route::get('/fill-email-change-email', [AuthController::class, 'fillEmailChangeEmail'])->name('fillEmailChangeEmail');

Route::post('/send-email-password-reset', [AuthController::class, 'sendEmailPasswordReset'])->name('sendEmailPasswordReset');
Route::post('/send-email-mail-change', [AuthController::class, 'sendEmailChangeEmail'])->name('sendEmailChangeEmail');

Route::post('/password-reset', [AuthController::class, 'passwordReset'])->name('passwordReset');
Route::get('/password-reset', [AuthController::class, 'passwordResetForm'])->name('passwordResetForm');

Route::post('/email-change', [AuthController::class, 'changeEmail'])->name('changeEmail');
Route::get('/email-change', [AuthController::class, 'changeEmailForm'])->name('changeEmailForm');

Route::post('/upload/{id}', [ProfileController::class, 'upload'])->name('upload');

Route::post('/blog/create', [BlogController::class, 'create'])->name('createBlog');
Route::get('/blog/create', [BlogController::class, 'index'])->name('blog_add_form');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

    Route::post('/blogs/{blog}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::post('/search', [BlogController::class, 'search']);
});
