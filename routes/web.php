<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\MotorcycleRent;
use App\Livewire\MotorcycleList;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/motorcycles', MotorcycleList::class)->name('motorcycle.list');

Route::get('/rent-motorcycle/{id}/{slug}', MotorcycleRent::class)
    ->name('motorcycle.rent');


require __DIR__.'/auth.php';
