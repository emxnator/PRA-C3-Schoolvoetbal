<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::get('/toernooien', [TournamentController::class, 'index'])->name('toernooien');

Route::get('/contact', function () {
    return view('contact.page');
})->name('contact');

Route::get('/teams', function () {
    return view('teams');
})->name('teams');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

