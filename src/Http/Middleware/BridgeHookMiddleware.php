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
        if (!config('bridge.webhooks.secret_enable', false)) {
            return $next($request);
        }
        $data = $request->input();
        $dataCheck = json_encode($data);
        $bridgeSignatureData = $request->header('Bridgeapi-Signature');
        foreach (explode(',', $bridgeSignatureData) as $signature) {
            if (static::verifySignature($signature, $dataCheck)) {
                foreach (config('bridge.webhooks.events', []) as $event) {
                    $event = new $event($data);
                    if ($event instanceof BridgeWebhookVerifiedEventInterface) {
                        event(new $event($data));
                    }
                }
                return $next($request);
            }
        }
        $exception = new WebhooksVerifySignatureException();
        throw new AccessDeniedHttpException($exception->getMessage(), $exception);
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
