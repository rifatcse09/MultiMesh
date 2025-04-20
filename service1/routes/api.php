<?php

use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {
    Route::get('/health-check', function () {
        return response()->json(['message' => 'Service is running']);
    });
});

// Correct route group declaration
// Route::prefix('api/v1')->as('v1:')->group(function () {
//     // Add your routes here
//     Route::get('/health-check', function () {
//         return response()->json(['message' => 'API is running']);
//     });
// });

// Route::prefix('api/v1')->group(function () {
//     Route::get('/health-check', function () {
//         return response()->json(['message' => 'API is running']);
//     });
// });
// Route::fallback(function(){
//     return response()->json([
//         'message' => 'Page Not Found. If error persists, contact https://wiaccount.jouleslabs.com/'], 404);
// });
// Route::get('/health-check', function () {
//     return response()->json(['message' => 'API is running']);
// });
