<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use HXM\Bridge\HttpClient\{
    Client,
    AsyncClient
};

class BridgeServiceProvider extends ServiceProvider
{

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Client::class, function(){
            return new Client;
        });
        $this->app->bind(AsyncClient::class, function(){
            return new AsyncClient;
        });
        $this->registerListeners();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(BridgeRouteServiceProvider::class);
        $this->registerConfig();
    }

    protected function registerListeners()
    {
        foreach (config('bridge.listeners', []) as $event => $listeners) {
            foreach (array_unique(Arr::wrap($listeners)) as $listener) {
                Event::listen($event, $listener);
            }
        }
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../config/bridge.php' => config_path('bridge.php'),
        ], 'config');
        $this->mergeConfigFrom(__DIR__.'/../config/bridge.php', 'bridge');
    }
}
