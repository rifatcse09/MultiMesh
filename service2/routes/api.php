<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Kafka\KafkaController;
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {
    // Route::get('/health-check', function () {
    //     return response()->json(['message' => 'Serivice 2']);
    // });
    Route::get('/kafka/consume', [KafkaController::class, 'consumeMessages']);
   // Route::get('/kafka/consume', 'V1\Restaurant\Kafka\KafkaController@consumeMessages')->name('kafka.consume');
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
