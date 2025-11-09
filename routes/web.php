<?php

use Illuminate\Support\Facades\Route;


Route::view('/', 'pages.main');
Route::view('/sign-in', 'pages.sign-in');
Route::view('/sign-up', 'pages.sign-up');
Route::view('/profile', 'pages.profile');