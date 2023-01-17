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

class UserApi
{
    const BASE_PATH = '/v2/users';

    static public function getList($uri = null): ApiResponseListInterface
    {
        return Client::wantList()->get($uri ?? static::BASE_PATH);
    }

    static public function get($id): ApiResponseInterface
    {
        return Client::get(static::BASE_PATH . "/$id");
    }

    static public function create($email, $password): ApiResponseInterface
    {
        return Client::post(static::BASE_PATH, ['json' => [
            'email' => $email,
            'password' => $password
        ]]);
    }
    static public function authenticate($email, $password): ApiResponseInterface
    {
        return Client::post('v2/authenticate', ['json' => [
            'email' => $email,
            'password' => $password
        ]]);
    }
    static public function logout($access_token): ApiResponseInterface
    {
        return Client::post('v2/logout', ['headers' => [
            'Authorization' => "Bearer $access_token"
        ]]);
    }

    static public function updateEmail($uuid, $email, $password): ApiResponseInterface
    {
        return Client::put(static::BASE_PATH."/$uuid/email", ['json' => [
            'new_email' => $email,
            'password' => $password
        ]]);
    }
    static public function updatePassword($uuid, $password, $currentPassword): ApiResponseInterface
    {
        return Client::put(static::BASE_PATH."/$uuid/password", ['json' => [
            'current_password' => $currentPassword,
            'new_password' => $password
        ]]);
    }
    static public function delete($uuid, $password): ApiResponseInterface
    {
        return Client::delete(static::BASE_PATH."/$uuid/delete", ['json' => [
            'password' => $password
        ]]);
    }
    static public function deleteAll(): ApiResponseInterface
    {
        return Client::delete(static::BASE_PATH);
    }
    static public function confirmation($access_token): ApiResponseInterface
    {
        return Client::get(static::BASE_PATH. "/me/email/confirmation", ['headers' => [
            'Authorization' => "Bearer $access_token"
        ]]);
    }
}
