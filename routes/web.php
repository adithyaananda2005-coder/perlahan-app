
<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::view('/admin', 'admin.dashboard')->name('admin.dashboard');

Route::view('/admin/lahan', 'admin.lahan')->name('admin.lahan');
