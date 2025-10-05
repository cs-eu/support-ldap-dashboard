<?php

use App\Http\Controllers\Auth\AdministrationAuthenticatedSessionController;
use App\Http\Controllers\Auth\GitLabAuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login/administration', [AdministrationAuthenticatedSessionController::class, 'redirect'])->name('login.redirect');

    Route::get('/login/administration/callback', [AdministrationAuthenticatedSessionController::class, 'callback'])->name('login.callback');

    Route::get('/exit', [AdministrationAuthenticatedSessionController::class, 'exit'])->name('exit');


    Route::get('auth/gitlab/redirect', [GitLabAuthenticatedSessionController::class, 'create'])
        ->name('gitlab.redirect');

    Route::match(['get', 'post'], 'auth/gitlab/callback', [GitLabAuthenticatedSessionController::class, 'store'])
        ->name('gitlab.callback');
});

Route::middleware('auth:web')->group(function () {
    Route::post('/logout/administration', [AdministrationAuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware('auth:insights')->group(function () {
    Route::post('/logout/insights', [GitLabAuthenticatedSessionController::class, 'destroy'])->name('insights.logout');
});
