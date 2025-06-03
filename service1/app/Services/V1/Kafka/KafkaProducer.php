<?php
namespace App\Services\V1\Kafka;

use RdKafka\Conf;
use RdKafka\Producer;
use RdKafka\ProducerTopic;

class KafkaProducer {

    protected string $brokerList;
    
    protected Producer $producer;

    public function __construct(string $brokerList)
    {
        $this->brokerList = $brokerList;

        $conf = new Conf();
        $conf->set('bootstrap.servers', $brokerList);
        // Optional: Add custom config here
        // $conf->set('log_level', (string) LOG_DEBUG);

        $this->producer = new Producer($conf);
        $this->producer->addBrokers($this->brokerList);
    }

    public function produce(string $topicName, string $message): void
    {
        $topic = $this->producer->newTopic($topicName);
        $topic->produce(RD_KAFKA_PARTITION_UA, 0, $message);
        $this->producer->poll(0); // Process events
        $this->producer->flush(1000); // Ensure delivery
    }
}