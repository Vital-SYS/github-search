<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::post('/find', [ApiController::class, 'find'])->name('find');
Route::get('/find', [ApiController::class, 'getSearches'])->name('getSearches');
Route::delete('/find/{id}', [ApiController::class, 'deleteSearch'])->name('deleteSearch');

