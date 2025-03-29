<?php

use Filament\Pages\Auth\Login;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', Login::class)
    ->name('filament.dashboard.auth.login')
    ->middleware('web');
