<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


# Admin Routes
require_once __DIR__ . '/auth.php';

#front end route
Route::get('/', [HomeController::class, 'index']);