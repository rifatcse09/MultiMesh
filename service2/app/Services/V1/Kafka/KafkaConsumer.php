<?php
namespace App\Services\V1\Kafka;

use RdKafka\Conf;
use RdKafka\KafkaConsumer as RdKafkaConsumer;
use RdKafka\Message;
use Exception;

class KafkaConsumer
{
    protected string $brokerList;
    protected string $groupId;
    protected RdKafkaConsumer $consumer;

    public function __construct(string $brokerList, string $groupId)
    {
        $this->brokerList = $brokerList;
        $this->groupId = $groupId;

        $conf = new Conf();
        $conf->set('group.id', $this->groupId);
        $conf->set('metadata.broker.list', $this->brokerList);

        $this->consumer = new RdKafkaConsumer($conf);
    }

    /**
     * Subscribe to the topic and start consuming messages.
     */
    public function consume(string $topicName, int $timeoutMs = 10000): void
    {
        $this->consumer->subscribe([$topicName]);

        echo "Kafka Consumer started on topic '{$topicName}'\n";

        while (true) {
            $message = $this->consumer->consume($timeoutMs);

            switch ($message->err) {
                case RD_KAFKA_RESP_ERR_NO_ERROR:
                    echo sprintf("Message received: %s\n", $message->payload);
                    break;

                case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                    echo "End of partition, waiting for new messages...\n";
                    break;

                case RD_KAFKA_RESP_ERR__TIMED_OUT:
                    echo "Consume timed out...\n";
                    break;

                default:
                    throw new Exception($message->errstr(), $message->err);
            }
        }
    }
}