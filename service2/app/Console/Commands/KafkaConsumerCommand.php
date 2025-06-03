<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use RdKafka\Conf;
use RdKafka\KafkaConsumer as RdKafkaConsumer;
use RdKafka\Consumer;
use RdKafka\ConsumerTopic;
use RdKafka\Message;

class KafkaConsumerCommand extends Command
{
    protected $signature = 'kafka:consume';
    protected $description = 'Consume Kafka messages using php-rdkafka';

    public function handle()
    {
        $conf = new Conf();
        $conf->set('metadata.broker.list', 'kafka:9092');
        //$conf->set('group.id', 'Combined Lag');
        $conf->set('group.id', 'my-consumer-group'); // dynamic
        $conf->set('auto.offset.reset', 'earliest');
        $consumer = new RdKafkaConsumer($conf);
        $consumer->subscribe(["test_topic"]);

        $this->info("Kafka consumer started on topic 'test_topic'");

        while (true) {
            $message = $consumer->consume(1200); // wait max 120s
           // dd( $message->err);
            switch ($message->err) {
                case RD_KAFKA_RESP_ERR_NO_ERROR:
                    $this->info('Message received: ' . $message->payload);
                    break;
                case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                    $this->warn('No more messages; waiting...');
                    break;
                case RD_KAFKA_RESP_ERR__TIMED_OUT:
                    $this->error('Timed out...');
                    break;
                default:
                    $this->error($message->errstr());
                    break;
            }
        }
    }

}