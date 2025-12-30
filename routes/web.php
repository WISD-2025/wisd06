<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/bb/b1', function () {
    return view('bb.b1');
});

Route::get('/bb/b2', function () {
    return view('bb.b2');
});

Route::get('/aa/a1', function () {
    return view('aa.a1');
});

Route::get('/aa/a2', function () {
    return view('aa.a2');
});


Route::get('/dd/d1', function () {
    return view('dd.d1');
});

Route::get('/dd/d2', function () {
    return view('dd.d2');
});
Route::get('/cc/c1', function () {
    return view('cc.c1');
});

Route::get('/cc/c2', function () {
    return view('cc.c2');

});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
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
