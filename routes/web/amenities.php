<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmenityController;

Route::middleware(['auth'])->group(function () {
    Route::resource('amenities', AmenityController::class);
}); 