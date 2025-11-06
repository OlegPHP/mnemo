<?php

use App\Http\Controllers\TheoryController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ExerciseWordController;
use App\Http\Controllers\ExerciseListController;
use App\Http\Controllers\ExercisePhoneController;
use App\Http\Controllers\ExercisePasswordController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('theories', TheoryController::class);
    Route::resource('exercises', ExerciseController::class)->only(['index', 'show']);
    Route::prefix('exercises/{exercise}')->group(function () {
        // Английские слова
        Route::prefix('words')->group(function () {
            Route::get('start', [ExerciseWordController::class, 'start'])->name('exercises.words.start');
            Route::get('learn', [ExerciseWordController::class, 'learn'])->name('exercises.words.learn');
            Route::get('test', [ExerciseWordController::class, 'test'])->name('exercises.words.test');
            Route::post('result', [ExerciseWordController::class, 'result'])->name('exercises.words.result');
        });

        // Список покупок
        Route::prefix('list')->group(function () {
            Route::get('start', [ExerciseListController::class, 'start'])->name('exercises.list.start');
            Route::get('learn', [ExerciseListController::class, 'learn'])->name('exercises.list.learn');
            Route::get('test', [ExerciseListController::class, 'test'])->name('exercises.list.test');
            Route::post('result', [ExerciseListController::class, 'result'])->name('exercises.list.result');
        });

        // Номера телефонов
        Route::prefix('phones')->group(function () {
            Route::get('start', [ExercisePhoneController::class, 'start'])->name('exercises.phones.start');
            Route::get('learn', [ExercisePhoneController::class, 'learn'])->name('exercises.phones.learn');
            Route::get('test', [ExercisePhoneController::class, 'test'])->name('exercises.phones.test');
            Route::post('result', [ExercisePhoneController::class, 'result'])->name('exercises.phones.result');
        });

        // Пароли
        Route::prefix('passwords')->group(function () {
            Route::get('start', [ExercisePasswordController::class, 'start'])->name('exercises.passwords.start');
            Route::get('learn', [ExercisePasswordController::class, 'learn'])->name('exercises.passwords.learn');
            Route::get('test', [ExercisePasswordController::class, 'test'])->name('exercises.passwords.test');
            Route::post('result', [ExercisePasswordController::class, 'result'])->name('exercises.passwords.result');
        });
    });

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
