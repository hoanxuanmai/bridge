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

class ItemApi
{
    const BASE_PATH = '/v2/items';

    function getList($access_token): ApiResponseListInterface
    {
        return Client::wantList()->get(static::BASE_PATH, [
            'headers' => [
                'Authorization' => "Bearer $access_token"
            ]
        ]);
    }

    function getSingle($access_token, $id): ApiResponseInterface
    {
        return Client::get(static::BASE_PATH . "/$id", [
            'headers' => [
                'Authorization' => "Bearer $access_token"
            ]
        ]);
    }

    function refreshItem($access_token, $id): ApiResponseInterface
    {
        return Client::post(static::BASE_PATH . "/$id/refresh", [
            'headers' => [
                'Authorization' => "Bearer $access_token"
            ]
        ]);
    }

    function getRefreshItemStatus($access_token, $id): ApiResponseInterface
    {
        return Client::get(static::BASE_PATH . "/$id/refresh/status", [
            'headers' => [
                'Authorization' => "Bearer $access_token"
            ]
        ]);
    }

    function delete($access_token, $id): ApiResponseInterface
    {
        return Client::delete(static::BASE_PATH . "/$id", [
            'headers' => [
                'Authorization' => "Bearer $access_token"
            ]
        ]);
    }
}
