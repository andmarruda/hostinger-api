<?php
namespace Hostinger\Providers;

use Illuminate\Support\ServiceProvider;
use Hostinger\Services\Hostinger;

class HostingerServiceProvider extends ServiceProvider
{
    /**
     * Register the application services
     * 
     * @return void
     */
    public function register(): void
    {
        // permite publicar config via artisan
         $this->publishes([
        __DIR__ . '/../config/hostinger.php' => config_path('hostinger.php'),
        ], 'hostinger-config');

    }

    /**
     * Bootstrap the application services
     * 
     * @return void
     */
    public function boot(): void
    {
        $this->app->singleton(Hostinger::class, function ($app) {
            return new Hostinger(config('hostinger.token'));
        });
    }
}
