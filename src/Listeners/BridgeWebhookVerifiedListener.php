<?php

/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Listeners;

use HXM\Bridge\Events\BridgeWebhookVerifiedEvent;
use Illuminate\Support\Facades\Log;

class BridgeWebhookVerifiedListener
{
    function handle(BridgeWebhookVerifiedEvent $event)
    {
        Log::info(json_encode($event->getContent()));
    }
}
