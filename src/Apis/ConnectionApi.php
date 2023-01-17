<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Apis;

use HXM\Bridge\Contract\ApiResponseInterface;
use HXM\Bridge\Facades\Client;

class ConnectionApi
{
    const BASE_PATH = '/v2/connect';

    static public function connectItem($access_token, $email, $country = 'fr'): ApiResponseInterface
    {
        return Client::post('/v2/connect/items/add', [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
            ],
            'json' => [
                'prefill_email' => $email,
                'country' => $country
            ],
        ]);
    }

    static public function getItem($access_token, $itemId): ApiResponseInterface
    {
        return Client::get(static::BASE_PATH. "/items/edit", [
            'headers' => [
                'Authorization' => "Bearer $access_token"
            ],
            'query' => [
                'item_id' => $itemId,
            ]
        ]);
    }
    static public function syncItem($access_token, $itemId, $redirectLink = null): ApiResponseInterface
    {
        return Client::get(static::BASE_PATH. "/items/sync", [
            'headers' => [
                'Authorization' => "Bearer $access_token"
            ],
            'query' => [
                'item_id' => $itemId,
                'redirect_url' => $redirectLink
            ]
        ]);
    }
    static public function validateEmail($access_token, $redirectLink = null): ApiResponseInterface
    {
        return Client::get(static::BASE_PATH. "/users/email/confirmation", [
            'headers' => [
                'Authorization' => "Bearer $access_token"
            ],
            'query' => [
                'redirect_url' => $redirectLink
            ]
        ]);
    }
    static public function validateProItem($access_token, $redirectLink = null): ApiResponseInterface
    {
        return Client::get(static::BASE_PATH. "/items/pro/confirmation", [
            'headers' => [
                'Authorization' => "Bearer $access_token"
            ],
            'query' => [
                'redirect_url' => $redirectLink
            ]
        ]);
    }
    static public function managerAccounts($access_token, $country = null): ApiResponseInterface
    {
        return Client::get(static::BASE_PATH. "/manage/accounts/iban", [
            'headers' => [
                'Authorization' => "Bearer $access_token"
            ],
            'query' => [
                'country' => $country
            ]
        ]);
    }
}
