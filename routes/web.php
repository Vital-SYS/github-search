<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;


Route::get('/', [SearchController::class, 'index'])->name('index');
Route::post('/search', [SearchController::class, 'search'])->name('search');
Route::get('/results', [SearchController::class, 'results'])->name('results');
