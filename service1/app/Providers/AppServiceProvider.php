<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\V1\Kafka\KafkaProducer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(KafkaProducer::class, function ($app) {
            return new KafkaProducer(env('KAFKA_BROKER', 'localhost:9092'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }
}
