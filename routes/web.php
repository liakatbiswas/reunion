<?php

use App\Http\Controllers\Admin\ParticipantRegistrationController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ShowAllRegisteredController;
use App\Http\Controllers\TotalCalculationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::resource('/registration', RegistrationController::class)->only(['index', 'create']);
Route::resource('/batch', BatchController::class);
Route::get('/batch/{id}/friends', [ShowAllRegisteredController::class, 'index'])->name('show.all.friends');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/participants', [ParticipantRegistrationController::class, 'index'])->name('participants.index');
    Route::resource('/participants', ParticipantRegistrationController::class);

    Route::get('/account/total', [TotalCalculationController::class, 'total'])->name('account.total');
    Route::get('/account/800', [TotalCalculationController::class, 'show800'])->name('account.show800');
    Route::get('/account/1000', [TotalCalculationController::class, 'show1000'])->name('account.show1000');

    Route::resource('/donors', DonorController::class);
});

require __DIR__.'/auth.php';
