<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Services\Income\Controller\IncomeController;

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});


Route::get('/dashboard', function () {
    return Inertia::render('Frontend/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Income Route


Route::get('/income',[IncomeController::class, 'index'])->middleware(['auth', 'verified'])->name('index');

Route::get('/addIncome', function () {
    return Inertia::render('Income/addIncome');
})->middleware(['auth', 'verified'])->name('addIncome');

Route::post('/saveIncome', [IncomeController::class, 'create'])->middleware(['auth', 'verified'])->name('saveIncome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/editIncome/{id}/edit', [IncomeController::class, 'edit'])->name('editIncome');
    Route::put('/editIncome/{id}', [IncomeController::class, 'update'])->name('updateIncome');
});

Route::delete('/deleteIncome/{id}', [IncomeController::class, 'destroy'])->middleware(['auth', 'verified'])->name('deleteIncome');

//end of income route



//expenses route



//end of expences route
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
