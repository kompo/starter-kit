<?php

use Illuminate\Support\Facades\Route;

Route::layout('layouts.guest')->middleware(['guest:web'])->group(function(){

	Route::get('login', App\Kompo\Auth\LoginForm::class)->name('login');

	Route::get('register', App\Kompo\Auth\RegisterForm::class)->name('register');

	Route::get('forgot-password', App\Kompo\Auth\ForgotPasswordForm::class)->name('password.request');

	Route::get('reset-password/{token}', App\Kompo\Auth\ResetPasswordForm::class)->name('password.reset');
	
});
