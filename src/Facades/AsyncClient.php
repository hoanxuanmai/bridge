<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Facades;

use GuzzleHttp\Promise\PromiseInterface;
use HXM\Bridge\HttpClient\AsyncClient as BaseClient;
use Illuminate\Support\Facades\Facade;


/**
 *
 * @method static BaseClient onSuccess(callable $onSuccess)
 * @method static BaseClient onError(callable $onError)
 * @method static PromiseInterface get(string $uri, array $data)
 * @method static PromiseInterface post(string $uri, array $data)
 * @method static PromiseInterface put(string $uri, array $data)
 * @method static PromiseInterface patch(string $uri, array $data)
 * @method static PromiseInterface request(string $method, string $uri, array $data)
 *
 * @see \HXM\Bridge\HttpClient\AsyncClient
 */
class AsyncClient extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return BaseClient::class;
    }
}
