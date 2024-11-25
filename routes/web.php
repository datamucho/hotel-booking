<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/web/auth.php';
require __DIR__.'/web/rooms.php';
require __DIR__.'/web/bookings.php';
