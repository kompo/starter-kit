<?php

use Illuminate\Support\Facades\Route;

//All routes using the main layout (no middleware, only a Navbar)
Route::layout('layouts.main')->group(function(){

    Route::get('/', App\Kompo\Home\HomeView::class)->name('home');

});

//All routes using the dashboard layout ('auth' middleware, Navbar + Sidebar)
Route::layout('layouts.dashboard')->middleware(['auth'])->group(function(){

    Route::get('dashboard', App\Kompo\Dashboard\DashboardView::class)->name('dashboard');

});

//Kompo Modules Routes
include __DIR__.'/kompo/basic-auth.php';