<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Contract;

use Psr\Http\Message\ResponseInterface;

interface ApiResponseListInterface
{
    public function getData();
    public function hasError();
    public function getCode();
    public function getError();
    public function getMessage();
    public function getList();
    public function getPagination();
}
