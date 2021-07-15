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

namespace Raylin666\Client\Factory;

use Swoole\Client;

/**
 * Class ClientFactory
 * @package Raylin666\Client\Factory
 */
class ClientFactory extends ClientFactoryAbstract
{
    /**
     * @return Client
     */
    protected function newSwooleClient(): Client
    {
        // TODO: Implement newSwooleClient() method.

        return new Client($this->sock_type, SWOOLE_SOCK_SYNC);
    }
}