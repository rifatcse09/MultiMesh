<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Restaurant;

use Illuminate\Http\Request;
use App\Models\RestaurantInfo;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\V1\Restaurant\RestaurantService;
use App\Http\Requests\V1\Restaurant\RestaurantCreateRequest;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->input('message', 'Default message');

        $producer = app('kafka-producer');
        $topic = $producer->newTopic('service-communication');
        $topic->produce(RD_KAFKA_PARTITION_UA, 0, json_encode([
            'message' => $message,
            'sender' => 'service1',
            'timestamp' => now()->toDateTimeString()
        ]));

        $producer->flush(1000);

        return response()->json([
            'status' => 'success',
            'sent_message' => $message
        ]);
    }
}
