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

use Raylin666\Client\Contract\SwooleClientInterface;
use Raylin666\Client\Swoole\SwooleClient;

/**
 * Class ClientFactory
 * @package Raylin666\Client\Factory
 */
class ClientFactory extends ClientFactoryAbstract
{
    /**
     * @return SwooleClientInterface
     */
    protected function newSwooleClient(): SwooleClientInterface
    {
        // TODO: Implement newSwooleClient() method.

        return new SwooleClient($this->sock_type);
    }
}