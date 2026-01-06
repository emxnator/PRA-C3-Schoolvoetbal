<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\MatchController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/signup', function () {
    return view('auth.register');
})->name('signup');

Route::get('/toernooien', [TournamentController::class, 'index'])->name('toernooien');
Route::get('/toernooien/{tournament}', [TournamentController::class, 'show'])->name('tournaments.show');
Route::post('/toernooien/{tournament}/archive', [TournamentController::class, 'archive'])->middleware(['auth', 'admin'])->name('tournaments.archive');
Route::get('/archief', [TournamentController::class, 'archiveIndex'])->name('tournaments.archiveIndex');
Route::put('/matches/{match}', [MatchController::class, 'update'])->middleware(['auth', 'admin'])->name('matches.update');
Route::get('/teams', [TeamController::class, 'index'])->name('teams');
Route::resource('/tournaments', TournamentController::class);
Route::resource('/matches', MatchController::class);

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'admin'])->name('admin');
route::delete('/admin/{id}', [AdminController::class, 'destroy'])->middleware(['auth', 'admin'])->name('admin.destroy');
Route::patch('/admin/toggle/{id}', [AdminController::class, 'toggleAdmin'])->middleware(['auth', 'admin'])->name('admin.toggle');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/information', function () {
    return view('pages.information');
})->name('information');