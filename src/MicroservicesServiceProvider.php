<?php

namespace Buqiu\MicroservicesRequest;

use Illuminate\Support\ServiceProvider;

class MicroservicesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishesConfiguration();
    }

    private function publishesConfiguration()
    {
        $this->publishes([
            __DIR__."/../config/microservices.php" => config_path('microservices.php'),
        ], 'buqiu-microservices-config');
    }
}
