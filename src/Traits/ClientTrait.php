<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Traits;


use GuzzleHttp\Exception\GuzzleException;
use HXM\Bridge\Contract\ApiResponseInterface;
use HXM\Bridge\Responses\ApiListResponse;
use HXM\Bridge\Responses\ApiResponse;
use Psr\Http\Message\ResponseInterface;

trait ClientTrait
{
    public bool $isListing = false;
    public string $resources = 'resources';
    public string $error;
    public ResponseInterface $response;

    /**
     * @param $uri
     * @param array $options
     * @return ApiResponseInterface
     */
    public function get($uri, array $options = []): ApiResponseInterface
    {
        return $this->request('GET', $uri, $options);
    }

    /**
     * @param $uri
     * @param array $options
     * @return ApiResponseInterface
     */
    public function head($uri, array $options = []): ApiResponseInterface
    {
        return $this->request('HEAD', $uri, $options);
    }

    /**
     * @param $uri
     * @param array $options
     * @return ApiResponseInterface
     */
    public function put($uri, array $options = []): ApiResponseInterface
    {
        return $this->request('PUT', $uri, $options);
    }

    /**
     * @param $uri
     * @param array $options
     * @return ApiResponseInterface
     */
    public function post($uri, array $options = []): ApiResponseInterface
    {
        return $this->request('POST', $uri, $options);
    }

    /**
     * @param $uri
     * @param array $options
     * @return ApiResponseInterface
     */
    public function patch($uri, array $options = []): ApiResponseInterface
    {
        return $this->request('PATCH', $uri, $options);
    }

    /**
     * @param $uri
     * @param array $options
     * @return ApiResponseInterface
     */
    public function delete($uri, array $options = []): ApiResponseInterface
    {
        return $this->request('DELETE', $uri, $options);
    }

    /**
     * @param string $method
     * @param $uri
     * @param array $options
     * @return ApiResponseInterface
     * @throws GuzzleException
     */
    public function request(string $method, $uri, array $options = []): ApiResponseInterface
    {
        $parseUrl = parse_url($uri ?? '');
        $uri = $parseUrl['path'] ?? '';
        $queryParse = collect(explode('&', $parseUrl['query'] ?? ''))
            ->filter()
            ->mapWithKeys(function ($dt){
                $temp = explode('=', $dt);
                return [$temp[0] => $temp[1] ?? ''];
            })
            ->filter(function($dt) {
                return $dt != '';
            });
        $options['query'] = array_merge($options['query'] ?? [], $queryParse->toArray());
        try {
            $response = $this->client->request($method, $uri, $options);
            if ($this->isListing) {
                $response = ApiListResponse::buildFromSuccess($response, $this->resources);
            } else {
                $response = ApiResponse::buildFromSuccess($response);
            }

        } catch (\Exception $e) {
            $response = $this->isListing ? ApiListResponse::buildFromError($e) : ApiResponse::buildFromError($e);
        }
        $this->isListing = false;

        return $response;
    }
}
