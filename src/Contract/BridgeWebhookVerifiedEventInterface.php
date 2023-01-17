<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Contract;

interface BridgeWebhookVerifiedEventInterface
{
    public function __construct(array $data = []);

    /**
     * @return string|null
     */
    public function getType(): ?string;

    /**
     * @return array
     */
    public function getContent(): array;
}
