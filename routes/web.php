<?php

use Illuminate\Support\Facades\Route;

//Controllers
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'listing'])->name('listing');
Route::get('/listing-edit', [MainController::class, 'edit'])->name('listing.edit');
Route::post('/listing-operations/{type}', [MainController::class, 'operations']);


