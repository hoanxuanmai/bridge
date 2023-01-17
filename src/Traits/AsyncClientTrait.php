<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use HXM\Bridge\Contract\ApiResponseInterface;
use Psr\Http\Message\ResponseInterface;

trait AsyncClientTrait
{
    /**
     * @var \Closure|null
     */
    protected ?\Closure $onSuccess;

    /**
     * @var \Closure|null
     */
    protected ?\Closure $onError;

    /**
     * @param callable $onSuccess
     * @return self
     */
    function onSuccess(callable $onSuccess): self
    {
        $this->onSuccess = $onSuccess;
        return $this;
    }

    /**
     * @param callable $onError
     * @return self
     */
    function onError(callable $onError): self
    {
        $this->onError = $onError;
        return $this;
    }

    /**
     * @param $uri
     * @param array $options
     * @return PromiseInterface
     */
    public function get($uri, array $options = [])
    {
        return $this->request('GET', $uri, $options);
    }

    /**
     * @param $uri
     * @param array $options
     * @return PromiseInterface
     */
    public function head($uri, array $options = []): PromiseInterface
    {
        return $this->request('HEAD', $uri, $options);
    }

    /**
     * @param $uri
     * @param array $options
     * @return PromiseInterface
     */
    public function put($uri, array $options = []): PromiseInterface
    {
        return $this->request('PUT', $uri, $options);
    }

    /**
     * @param $uri
     * @param array $options
     * @return PromiseInterface
     */
    public function post($uri, array $options = []): PromiseInterface
    {
        return $this->request('POST', $uri, $options);
    }

    /**
     * @param $uri
     * @param array $options
     * @return PromiseInterface
     */
    public function patch($uri, array $options = []): PromiseInterface
    {
        return $this->request('PATCH', $uri, $options);
    }

    /**
     * @param $uri
     * @param array $options
     * @return PromiseInterface
     */
    public function delete($uri, array $options = []): PromiseInterface
    {
        return $this->request('DELETE', $uri, $options);
    }

    /**
     * @param string $method
     * @param $uri
     * @param array $options
     * @return PromiseInterface
     */
    public function request(string $method, $uri, array $options = []): PromiseInterface
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

        $response = $this->client->requestAsync($method, $uri, $options);

        $response->then($this->onSuccess ?? function(){}, $this->onSuccess ?? function(){});
        $this->onSuccess = null;
        $this->onError = null;

        return $response;
    }
}
