<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge;

use HXM\Bridge\Http\Middleware\BridgeHookMiddleware;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class BridgeRouteServiceProvider extends RouteServiceProvider
{
    public function map()
    {
        Route::prefix((string) config('bridge.webhooks.prefix', 'webhooks/bridge'))
            ->middleware(config('bridge.webhooks.middlewares', [BridgeHookMiddleware::class]))
            ->group(__DIR__.'/Routes/hooks.php');
    }
}
