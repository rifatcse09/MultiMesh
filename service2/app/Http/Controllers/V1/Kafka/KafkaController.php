<?php

namespace App\Http\Controllers\V1\Kafka;

use App\Http\Controllers\Controller;
use App\Services\V1\Kafka\KafkaConsumer;

class KafkaController extends Controller
{
    protected $consumer;

    public function __construct(KafkaConsumer $consumer)
    {
        $this->consumer = $consumer;
    }
    public function consumeMessages()
    {
        //dd('aa');
       // $brokerList = "localhost:9092";
       // $groupId = "test_group";
        $topicName = "test_topic";

       // $consumer = new KafkaConsumer($brokerList, $groupId, $topicName);
        $this->consumer->consume($topicName);
    }
}
