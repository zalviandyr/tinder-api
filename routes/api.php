<?php

use App\Http\Controllers\Api\PersonController;
use Illuminate\Support\Facades\Route;

Route::apiResource('persons', PersonController::class)
    ->only(['index']);
