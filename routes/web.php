<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return redirect('/login');
});

// Login
Route::get('/login', [CategoryController::class, 'index']);
Route::post('/login', [CategoryController::class, 'login']);

// Signup
Route::get('/signup', [CategoryController::class, 'create']);
Route::post('/register', [CategoryController::class, 'store']);

// Logout - POST for security
Route::post('/logout', [CategoryController::class, 'logout'])->name('logout');

// Homepage (after login)
Route::get('/homepage', [CategoryController::class, 'homepage']);



// Profile routes
Route::get('/profile', [CategoryController::class,'profile']);
Route::post('/profile', [CategoryController::class,'updateProfile']);
Route::post('/profile/project', [CategoryController::class,'addProject']);
Route::delete('/profile/project/delete/{index}', [CategoryController::class,'deleteProject']);


// Projects
Route::post('/profile/project', [CategoryController::class,'addProject']);

// Change password (for logged-in users)
Route::get('/change-password', [CategoryController::class, 'showChangePassword']);
Route::post('/change-password', [CategoryController::class, 'updatePassword']);

// Forgot password
Route::get('/forgot-password', [CategoryController::class, 'showForgotPassword']);
Route::post('/forgot-password', [CategoryController::class, 'submitForgotPassword']);

// Reset password (via email link)
Route::get('/reset-password', [CategoryController::class, 'showResetPassword']);
Route::post('/reset-password', [CategoryController::class, 'submitResetPassword']);
