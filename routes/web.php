<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

// This is to redirect the root URL to the login page
Route::get('/', function () {
    return redirect()->route('login');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    /**
     * Department Routes
     */
    Route::get('/department', \App\Livewire\Department\Index::class)->name('department.index');
    Route::get('/department/archived', \App\Livewire\Department\Archived::class)->name('department.archived');

    /**
     * End User Routes
     */
    Route::get('/end-users', \App\Livewire\EndUser\Index::class)->name('endUsers');
});

require __DIR__ . '/auth.php';
