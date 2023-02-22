<?php

/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Http\Middleware;

use HXM\Bridge\Contract\BridgeWebhookVerifiedEventInterface;
use HXM\Bridge\Exceptions\WebhooksVerifySignatureException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BridgeHookMiddleware
{
    /**
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    function handle(Request $request, \Closure $next)
    {
        $data = $request->input();

        if (!config('bridge.webhooks.secret_enable', false)) {
            $this->fireEvents($data);
            return $next($request);
        }

        $dataCheck = $request->getContent();
        $bridgeSignatureData = $request->header('Bridgeapi-Signature');
        foreach (explode(',', $bridgeSignatureData) as $signature) {
            if (static::verifySignature($signature, $dataCheck)) {
                $this->fireEvents($data);
                return $next($request);
            }
        }
        $exception = new WebhooksVerifySignatureException();
        return response()->json([
            'message' => $exception->getMessage(),
        ], 403);
//        throw new AccessDeniedHttpException($exception->getMessage(), $exception);
    }

    /**
     * @param $data
     * @return void
     */
    function fireEvents($data)
    {
        foreach (config('bridge.webhooks.events', []) as $event) {
            $event = new $event();
            if ($event instanceof BridgeWebhookVerifiedEventInterface) {
                event(new $event($data));
            }
        }
    }

    /**
     * @param string $signature
     * @param string $data
     * @return bool
     */
    static function verifySignature(string $signature,string $data): bool
    {
        return strtolower(preg_replace('/^v\d=/', '', $signature))
            === hash_hmac('sha256', $data, config('bridge.webhooks.secret_code'));
    }
}
