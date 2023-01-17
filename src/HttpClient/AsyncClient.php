<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\HttpClient;

use GuzzleHttp\BodySummarizer;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use HXM\Bridge\Traits\AsyncClientTrait;

class AsyncClient
{
    use AsyncClientTrait;

    /**
     * @var ClientInterface
     */
    private ClientInterface $client;

    /**
     * @param null|ClientInterface $client
     */
    public function __construct(ClientInterface $client = null)
    {
        $this->client = $client ?? $this->buildClient();
    }

    private function buildClient(): \GuzzleHttp\Client
    {
        $stack = null;
        if (class_exists(BodySummarizer::class)) {
            $bodySummarizer = new BodySummarizer(240);
            $stack = HandlerStack::create();
            $stack->remove('http_errors');
            $stack->unshift(Middleware::httpErrors($bodySummarizer), 'http_errors');
        }
        return new \GuzzleHttp\Client([
            'handler' => $stack,
            'base_uri' => config('bridge.base_url', 'https://api.bridgeapi.io'),
            'headers' => [
                "Client-Id" => config('bridge.client_id'),
                "Client-Secret" => config('bridge.client_secret'),
                "Bridge-Version" => config('bridge.bridge_version'),
            ],
        ]);
    }
}
