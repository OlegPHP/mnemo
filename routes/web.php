<?php

use App\Http\Controllers\TheoryController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ExerciseWordController;
use App\Http\Controllers\ExerciseListController;
use App\Http\Controllers\ExercisePhoneController;
use App\Http\Controllers\ExercisePasswordController;
use App\Http\Controllers\DescriptionController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\AppearanceController;


Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : view('welcome');
})->name('home');

Route::get('description', [DescriptionController::class, 'index'])->name('description');
Route::get('description/{theory}', [DescriptionController::class, 'show'])->name('description.show');

Route::redirect('/dashboard', '/result')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::resource('theories', TheoryController::class);
    Route::resource('exercises', ExerciseController::class)->only(['index', 'show']);
    Route::get('result', [ExerciseController::class, 'result'])->name('result');
    Route::get('result/{type}', [ExerciseController::class, 'resultType'])->name('result.type');
    Route::delete('result/{type}/reset', [ExerciseController::class, 'resetResult'])->name('result.reset');

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

    Route::get('settings/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('settings/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('settings/password', [PasswordController::class, 'edit'])->name('password.edit');
Route::put('settings/password', [PasswordController::class, 'update'])->name('password.update');

});

require __DIR__.'/auth.php';
