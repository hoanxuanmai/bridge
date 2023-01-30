<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Apis;

use HXM\Bridge\Contract\ApiResponseInterface;
use HXM\Bridge\Contract\ApiResponseListInterface;
use HXM\Bridge\Facades\Client;


class AccountApi
{
    const BASE_PATH = '/v2/accounts';

    static function getList($access_token, $uri = null): ApiResponseListInterface
    {
        return Client::wantList()->get($uri ?? static::BASE_PATH, [
            'headers' => [
                'Authorization' => "Bearer $access_token"
            ]
        ]);
    }

    static function getSingle($access_token, $id): ApiResponseInterface
    {
        return Client::get(static::BASE_PATH . "/$id", [
            'headers' => [
                'Authorization' => "Bearer $access_token"
            ]
        ]);
    }

    static function getConnectorStatus(): ApiResponseInterface
    {
        return Client::wantList('')->get(static::BASE_PATH . "/insights");
    }
}
