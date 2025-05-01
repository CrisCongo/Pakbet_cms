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
Route::get('/blogs/edit', [BlogController::class, 'edit'])->name('blog.edit');
Route::get('/blogs/add', [BlogController::class, 'add'])->name('blog.add');

Route::get('/FAQs', [FAQcontroller::class, 'index'])->name('faqs.index');
Route::post('/FAQs/updateStatus', [FAQcontroller::class, 'updateStatus'])->name('faq.updateStatus');
Route::get('/FAQs/edit/{id}', [FAQcontroller::class, 'edit'])->name('faq.edit');
Route::put('/FAQs/update/{id}', [FAQcontroller::class, 'update'])->name('faq.update');
Route::get('/FAQs/add', [FAQcontroller::class, 'add'])->name('faq.add');
Route::put('/FAQs', [FAQcontroller::class, 'store'])->name('faqs.store');


Route::get('/prosperGuide', [GuideController::class, 'index'])->name('guide.index');
Route::get('/prosperGuide/edit', [GuideController::class, 'edit'])->name('guide.edit');
Route::get('/prosperGuide/add', [GuideController::class, 'add'])->name('guide.add');
