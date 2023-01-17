<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Contract;

interface ApiResponseInterface
{
    public function getData();
    public function hasError();
    public function getCode();
    public function getError();
    public function getMessage();
}
