<?php
// +----------------------------------------------------------------------
// | Created by linshan. 版权所有 @
// +----------------------------------------------------------------------
// | Copyright (c) 2021 All rights reserved.
// +----------------------------------------------------------------------
// | Technology changes the world . Accumulation makes people grow .
// +----------------------------------------------------------------------
// | Author: kaka梦很美 <1099013371@qq.com>
// +----------------------------------------------------------------------

namespace Raylin666\Client\Swoole;

use Raylin666\Client\Factory\ClientAbstract;
use Swoole\Coroutine\Client;

/**
 * Class SwooleCoroutineClient
 * @package Raylin666\Client\Swoole
 */
class SwooleCoroutineClient extends ClientAbstract
{
    /**
     * @param int $sock_type
     */
    public function __initialize(int $sock_type)
    {
        $this->client = new Client($sock_type);
    }
}