<?php
declare(strict_types=1);

namespace App\Http\Controllers\V1\Kafka;

use App\Http\Controllers\Controller;
use App\Services\V1\Kafka\KafkaProducer;

class KafkaController extends Controller
{
    protected $producer;

    public function __construct(KafkaProducer $producer)
    {
        $this->producer = $producer;
    }
    public function publishMessage()
    {
        // $brokerList = "localhost:9092";
        $topicName = "my-topic";
        $message = "Hello from laravel kafaka";

        // $producer = new KafkaProducer($brokerList);
        $this->producer->produce($topicName, $message);
    }
}
