<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); })->name('welcome');

Route::get('/inscription', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/inscription', [AuthController::class, 'register']);

Route::get('/connexion', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/connexion', [AuthController::class, 'login']);

Route::post('/deconnexion', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [IdeaController::class, 'index'])->name('dashboard');

    Route::resource('ideas', IdeaController::class)->except('show');
});
