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


class TransferApi
{
    const BASE_PATH = '/v2/transfers';

    static function refreshAccounts($access_token): ApiResponseInterface
    {
        return Client::post(static::BASE_PATH.'/accounts/refresh', [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/json'
            ],
            'body' => '{}'
        ]);
    }

    static function sendATransfer($access_token,array $data): ApiResponseInterface
    {
        return Client::post('/v2/pay/transfer', [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
            ],
            'json' => $data
        ]);
    }

    static function getList($access_token): ApiResponseListInterface
    {
        return Client::wantList()->get(static::BASE_PATH, [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
            ]]);
    }

    static function getSingle($access_token, $id): ApiResponseInterface
    {
        return Client::get(static::BASE_PATH."/$id", [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
            ]]);
    }
    static function getListBulks($access_token): ApiResponseListInterface
    {
        return Client::wantList()->get('/v2/bulk-transfers', [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
            ]]);
    }

    static function getSingleBulk($access_token, $id): ApiResponseInterface
    {
        return Client::get("/v2/bulk-transfers/$id", [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
            ]]);
    }

    static function getListSenderAccounts($access_token): ApiResponseListInterface
    {
        return Client::wantList()->get(self::BASE_PATH."/accounts/senders", [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
            ]]);
    }
}
