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

namespace Raylin666\Client;

use Raylin666\Client\Contract\ClientFactoryInterface;
use Raylin666\Client\Contract\ClientInterface;
use Raylin666\Client\Factory\ClientCoroutineFactory;
use Raylin666\Client\Factory\ClientFactory;
use Raylin666\Utils\Coroutine\Coroutine;

/**
 * Class Client
 * @package Raylin666\Client
 */
class Client implements ClientInterface
{
    /**
     * 客户端工厂类
     * @var null|ClientFactoryInterface
     */
    protected $clientFactory;

    /**
     * 实例 Client 客户端
     * @return ClientInterface
     */
    public function __invoke(): ClientInterface
    {
        // TODO: Implement __invoke() method.

        if (Coroutine::inCoroutine()) {
            $this->clientFactory = new ClientCoroutineFactory();
        } else {
            $this->clientFactory = new ClientFactory();
        }

        return $this;
    }

    /**
     * 获取客户端工厂
     * @return null|ClientFactoryInterface
     */
    public function getFactory(): ClientFactoryInterface
    {
        // TODO: Implement getFactory() method.

        return $this->clientFactory;
    }
}