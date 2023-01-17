<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Responses;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use HXM\Bridge\Contract\ApiResponseInterface;
use HXM\Bridge\Contract\ApiResponseListInterface;
use Illuminate\Support\MessageBag;
use Psr\Http\Message\ResponseInterface;
use function Webmozart\Assert\Tests\StaticAnalysis\string;

class ApiResponse implements ApiResponseInterface
{
    protected $data;

    protected $exception;

    protected $statusCode;

    public function __construct($data, $statusCode = 200, $exception = null)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
        $this->exception = $exception;

    }

    public function getData()
    {
        return $this->data;
    }

    public function hasError(): bool
    {
        return !!$this->exception;
    }

    public function getCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return \Exception
     */
    public function getError()
    {
        return $this->exception;
    }

    /**
     * @return mixed|null|string
     */
    public function getMessage()
    {
        if (!$this->exception)
            return null;
        $message = $this->exception->getMessage();
        if ($this->exception instanceof ClientException && $this->exception->hasResponse()) {
            $body = json_decode($this->exception->getResponse()->getBody()->getContents());
            $message = $body->message ?? $message;
        }
        return $message;
    }

    static function buildFromSuccess(ResponseInterface $response): ApiResponseInterface
    {
        $data = json_decode($response->getBody()->getContents());
        $exception = null;
        if (json_last_error()) {
            $exception =  new \Exception(json_last_error_msg());
        }
        $statusCode = $response->getStatusCode();
        return new static($data, $statusCode, $exception);
    }

    static function buildFromError(\Exception $exception): ApiResponseInterface
    {
        $statusCode = $exception->getCode();
        return new static(null, $statusCode, $exception);
    }
}
