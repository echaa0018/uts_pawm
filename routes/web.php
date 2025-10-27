<?php

use App\Livewire\Layouts\AppLayout;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Auth\Login;

// Route bawaan login (Livewire)
Route::get('/login', Login::class)->name('login');

Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
 
    return redirect('/');
})->name('logout');

// Redirect '/' tergantung status login
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('home')
        : redirect()->route('login');
});

// Route yang butuh login & domain valid
Route::middleware(['auth', 'domainCheck'])->group(function () {
    Route::get('/home', Home::class)->name('home');

    // Administrator Routes
    Route::get('/user', \App\Livewire\Users\UserIndex::class)->name('user.index');
    Route::get('/role', \App\Livewire\Roles\RoleIndex::class)->name('role.index');
    Route::get('/role/{id}', \App\Livewire\Roles\RoleShow::class)->name('role.show');

    // Virtual Lab Routes
    Route::get('/virtual-lab', \App\Livewire\VirtualLab\VirtualLabIndex::class)->name('virtual-lab.index');
    Route::get('/virtual-lab/physics', \App\Livewire\VirtualLab\PhysicsLab::class)->name('virtual-lab.physics');
    Route::get('/virtual-lab/math', \App\Livewire\VirtualLab\MathLab::class)->name('virtual-lab.math');
    Route::get('/virtual-lab/chemistry', \App\Livewire\VirtualLab\ChemistryLab::class)->name('virtual-lab.chemistry');
});