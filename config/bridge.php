<?php

use HXM\Bridge\Http\Middleware\BridgeHookMiddleware;
use HXM\Bridge\Events\BridgeWebhookVerifiedEvent;
use HXM\Bridge\Listeners\BridgeWebhookVerifiedListener;

return [
    'name' => 'Bridge',
    'base_url' => 'https://api.bridgeapi.io',
    'client_id' => env('BRIDGE_CLIENT_ID', null),
    'client_secret' => env('BRIDGE_CLIENT_SECRET', null),
    'bridge_version' => '2021-06-01',
    'listeners' => [
        BridgeWebhookVerifiedEvent::class => [
            BridgeWebhookVerifiedListener::class,
        ]
    ],
    'webhooks' => [
        'prefix' => 'webhooks/bridge',
        'name' => 'bridge.webhook',
        'secret_enable' => env('BRIDGE_WEBHOOKS_SECRET_ENABLE', false),
        'secret_code' => env('BRIDGE_WEBHOOKS_SECRET_CODE', ''),
        'events' => [
            BridgeWebhookVerifiedEvent::class,
        ],
        'middlewares' => [
            BridgeHookMiddleware::class
        ]
    ]
];
