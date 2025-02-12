<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmokeAlertController;
use App\Http\Controllers\SmokeDetectorController;
use Illuminate\Support\Facades\Auth;


// Authentication Routes
Auth::routes();

// Home Controller Route
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('landing');

Route::get('/home', function () {
  return view('home');
})->middleware('auth'); 

Route::get('/about', function () {
  return view('about');
})->name('about');

Route::get('/terms', function () {
  return view('terms');
})->name('terms');


// Route for smoke level data (accessible without authentication middleware)
Route::get('/smoke-level', [SmokeAlertController::class, 'fetchData']);

Route::get('/check-smoke', [SmokeDetectorController::class, 'checkSmokeLevel']);


