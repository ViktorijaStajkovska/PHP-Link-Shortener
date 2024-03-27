<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;


Route::post('/shorten', [LinkController::class, 'shorten'])->name('link.shorten');
Route::get('/redirect/{shortCode}', [LinkController::class, 'redirect'])->name('link.redirect');
Route::get('/', [LinkController::class, 'index']);
Route::get('listUrls', [LinkController::class, 'listUrls'])->name('link.list');