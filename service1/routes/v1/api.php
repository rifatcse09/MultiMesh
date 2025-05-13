<?php

declare(strict_types=1);

//use Log;
use Illuminate\Support\Facades\Route;


Route::get('/health-check', function() {
    return response()->json(['message' => 'Service is running']);
});

