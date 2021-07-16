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
use Swoole\Client;

/**
 * Class SwooleClient
 * @package Raylin666\Client\Swoole
 */
class SwooleClient extends ClientAbstract
{
    /**
     * SwooleClient constructor.
     * @param int $sock_type
     */
    public function __construct(int $sock_type)
    {
        $this->client = new Client($sock_type, SWOOLE_SOCK_SYNC);
    }
}