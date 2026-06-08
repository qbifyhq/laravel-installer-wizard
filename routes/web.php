<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Install\Welcome;
use App\Livewire\Install\Verify;
use App\Livewire\Install\Requirements;
use App\Livewire\Install\Database;
use App\Livewire\Install\Import;

Route::get('/install', Welcome::class)->name('install.welcome');
Route::get('/install/verify', Verify::class)->name('install.verify');
Route::get('/install/requirements', Requirements::class)->name('install.requirements');
Route::get('/install/database', Database::class)->name('install.database');
Route::get('/install/import', Import::class)->name('install.import');

Route::middleware('installer')->group(function (): void {
    Route::get('/', function () {
        return '<h1>Welcome to the homepage!</h1>';
    });
});