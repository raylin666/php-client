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
 * Interface NetworkInterface
 * @package Raylin666\Client\Contract
 */
interface NetworkInterface
{
    /**
     * 网络传输加密
     * @param $data
     * @return mixed
     */
    public function encode($data);

    /**
     * 网络传输解密
     * @param $data
     * @return mixed
     */
    public function decode($data);
}