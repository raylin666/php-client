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

use Raylin666\Client\Contract\ClientFactoryInterface;
use Swoole\Client as SwooleClient;
use Swoole\Coroutine\Client as SwooleCoroutineClient;

/**
 * Class ClientFactoryAbstract
 * @package Raylin666\Client\Factory
 */
abstract class ClientFactoryAbstract implements ClientFactoryInterface
{
    /**
     * Socket 类型
     * @var int
     */
    protected $sock_type = SWOOLE_SOCK_TCP | SWOOLE_KEEP;

    /**
     * 客户端
     * \Swoole\Coroutine\Client | \Swoole\Client
     * @var
     */
    protected $client;

    /**
     * 设置 Socket 类型
     * @param int $sock_type
     * @return ClientFactoryInterface
     */
    public function withSockType(int $sock_type): ClientFactoryInterface
    {
        // TODO: Implement withSockType() method.

        $this->sock_type = $sock_type;
        return $this;
    }

    /**
     * 获取 Socket 类型
     * @return int
     */
    public function getSockType(): int
    {
        // TODO: Implement getSockType() method.

        return $this->sock_type;
    }

    /**
     * 获取 Client , 比如 \Swoole\Coroutine\Client | \Swoole\Client
     * @return mixed|SwooleClient|SwooleCoroutineClient
     */
    public function getClient()
    {
        // TODO: Implement get() method.

        if (($this->client instanceof SwooleClient) || ($this->client instanceof SwooleCoroutineClient)) {
            return $this->client;
        }

        $this->client = $this->newSwooleClient();
        return $this->client;
    }

    /**
     * 创建 Client , 比如 \Swoole\Coroutine\Client | \Swoole\Client
     * @return mixed
     */
    abstract protected function newSwooleClient();
}