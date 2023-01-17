<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Events;

use HXM\Bridge\Contract\BridgeWebhookVerifiedEventInterface;

class BridgeWebhookVerifiedEvent implements BridgeWebhookVerifiedEventInterface
{
    protected array $data;
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return data_get($this->data, 'type', null);
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return data_get($this->data, 'content', []);
    }
}
