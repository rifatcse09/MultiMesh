<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Closure;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';
    public string $backendPrefix = '';
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot()
    {

        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix(env('ROUTE_API_PREFIX', 'api'))
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

    }

    protected function configureRateLimiting() : void
    {
        RateLimiter::for(
            name: 'api',
            callback: static fn (Request $request) : Limit => Limit::perMinute(
                maxAttempts: 60,
            )->by(
                key: $request->user()?->id ?: $request->ip(),
            ),
        );
    }

    protected function registerRoutes(Closure $routesCallback, string $prefix = '')
    {
        $this->loadRoutesUsing = $routesCallback;
        $this->backendPrefix = $prefix;

        return $this;
    }
}
