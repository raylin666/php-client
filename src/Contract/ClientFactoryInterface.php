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

namespace Raylin666\Client\Contract;

/**
 * Interface ClientFactoryInterface
 * @package Raylin666\Client\Contract
 */
interface ClientFactoryInterface
{
    /**
     * 设置 Socket 类型
     * @param int $sock_type
     * @return ClientFactoryInterface
     */
    public function withSockType(int $sock_type): ClientFactoryInterface;

    /**
     * 获取 Socket 类型
     * @return int
     */
    public function getSockType(): int;

    /**
     * 获取客户端
     * @return SwooleClientInterface
     */
    public function getClient(): SwooleClientInterface;
}