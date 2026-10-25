<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'masyarakat.dashboard')->name('home');

Route::view('/dashboard', 'masyarakat.dashboard')->name('dashboard');
Route::view('/data-lahan', 'masyarakat.data-lahan')->name('data-lahan');