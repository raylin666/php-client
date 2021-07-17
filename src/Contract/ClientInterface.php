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
 * Interface ClientInterface
 * @package Raylin666\Client\Contract
 */
interface ClientInterface
{
    /**
     * 获取客户端工厂
     * @return ClientFactoryInterface
     */
    public function getFactory(): ClientFactoryInterface;
}