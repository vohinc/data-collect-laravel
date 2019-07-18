<?php

namespace Voh\DataCollectLaravel;

use Illuminate\Support\ServiceProvider;
use Voh\DataCollectLaravel\Facade\DataCollectApi;

/**
 * Class DataCollectProvider
 *
 * @package Voh\DataCollectLaravel
 */
class DataCollectProvider extends ServiceProvider
{
    /**
     * Config path
     *
     * @var string
     */
    private $configPath = __DIR__ . '/../config/data-collect.php';

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            $this->configPath => $this->app->configPath() . '/data-collect.php',
        ], 'config');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom($this->configPath, 'data-collect');

        $this->app->singleton(DataCollectApi::class, function () {
            return new ApiClient();
        });
    }
}
