<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Facades;

use HXM\Bridge\Contract\ApiResponseInterface;
use HXM\Bridge\HttpClient\Client as BaseClient;
use Illuminate\Support\Facades\Facade;


/**
 * @method static BaseClient wantList(string $resource = 'resources')
 * @method static ApiResponseInterface get(string $uri, array $data)
 * @method static ApiResponseInterface post(string $uri, array $data)
 * @method static ApiResponseInterface put(string $uri, array $data)
 * @method static ApiResponseInterface patch(string $uri, array $data)
 * @method static ApiResponseInterface delete(string $uri, array $data)
 * @method static ApiResponseInterface request(string $method, string $uri, array $data)
 *
 * @see \HXM\Bridge\HttpClient\Client
 */
class Client extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return BaseClient::class;
    }
}
