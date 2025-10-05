<?php

use App\Http\Controllers\Beamer\BeamerAccessController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

Route::get('language/{language}', function ($language) {
    Session()->put('locale', $language);

    return redirect()->back();
})->name('language');

Route::middleware('auth:web')-> group(function () {
    Route::get('/', function () {
        return Inertia::render('Welcome');
    })->name('welcome');

    Route::prefix('beamer')->group(function () {
        Route::get('unlock', [BeamerAccessController::class, 'retrieve'])->name('beamer');
        Route::post('unlock', [BeamerAccessController::class, 'create']);
    });
});


Route::prefix('insights')->middleware('auth:insights')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Insights/Dashboard');
    })->name('insights.dashboard');

    Route::prefix('beamer')->group(function () {
        Route::get('/', [BeamerAccessController::class, "retrieve_all"])->name('insights.beamer');
    });
});


require __DIR__.'/auth.php';
