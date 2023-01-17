<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Exceptions;

class WebhooksVerifySignatureException extends \Exception
{
    public function __construct($message = "Webhooks Verify Signature Failed", $code = 400)
    {
        parent::__construct($message, $code);
    }
}
