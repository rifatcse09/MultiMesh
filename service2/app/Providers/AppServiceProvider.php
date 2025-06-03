<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\V1\Kafka\KafkaConsumer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(KafkaConsumer::class, function ($app) {
            return new KafkaConsumer(env('KAFKA_BROKER', 'localhost:9092'), env('KAFKA_GROUP_ID', 'default-group'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }
}
