<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FAQcontroller;
use App\Http\Controllers\GuideController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');//may problem pa


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');//->middleware('auth'); <--mamaya na to hahahaha di pa ayos login

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');

Route::get('/FAQs', [FAQcontroller::class, 'index'])->name('faqs.index');

Route::get('/FAQs', [GuideController::class, 'index'])->name('guide.index');
