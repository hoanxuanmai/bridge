<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Responses;

use GuzzleHttp\Exception\ClientException;
use HXM\Bridge\Contract\ApiResponseInterface;
use HXM\Bridge\Contract\ApiResponseListInterface;
use Illuminate\Support\MessageBag;
use Psr\Http\Message\ResponseInterface;
use function Webmozart\Assert\Tests\StaticAnalysis\string;

class ApiListResponse extends ApiResponse implements ApiResponseListInterface, ApiResponseInterface
{
    protected string $resources;
    protected bool $hasPagination;

    public function __construct($data, $statusCode = 200, $exception = null, string $resources = 'resources')
    {
        parent::__construct($data, $statusCode, $exception);
        $this->resources = $resources;
        $this->hasPagination = !!$resources;
    }


    public function getList()
    {
        return $this->data ? ($this->resources ? $this->data->{$this->resources} ?? [] : $this->data) : [];
    }
    public function getPagination()
    {
        return $this->data && $this->hasPagination ? ($this->data->pagination ?? new \stdClass()) : new \stdClass();
    }
    static function buildFromSuccess(ResponseInterface $response, string $resources = 'resources'): ApiResponseInterface
    {
        $data = json_decode($response->getBody()->getContents());
        $exception = null;
        if (json_last_error()) {
            $exception =  new \Exception(json_last_error_msg());
        }
        $statusCode = $response->getStatusCode();
        return new static($data, $statusCode, $exception, $resources);
    }

}
