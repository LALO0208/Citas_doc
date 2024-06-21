<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::redirect('/', '/login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware(['checkrole:administrador'])->group(function () {
    Route::get('/IndexAdmin', function () {
        return Inertia::render('Admin/index');
    })->name('IndexAdmin');
});
Route::middleware(['checkrole:doctor'])->group(function () {
    Route::get('/IndexDoctor', function () {
        return Inertia::render('Doctor/index');
    })->name('IndexDoctor');
});