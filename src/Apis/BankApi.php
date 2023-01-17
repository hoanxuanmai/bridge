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


class BankApi
{
    const BASE_PATH = '/v2/banks';

    static function getList($uri = null): ApiResponseListInterface
    {
        return Client::wantList()->get($uri ?? static::BASE_PATH);
    }

    static function getSingle($id): ApiResponseInterface
    {
        return Client::get(static::BASE_PATH . "/$id");
    }

    static function getConnectorStatus(): ApiResponseInterface
    {
        return Client::wantList('')->get(static::BASE_PATH . "/insights");
    }
}
