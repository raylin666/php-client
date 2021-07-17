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

namespace Raylin666\Client\Handler;

use Raylin666\Client\Contract\NetworkInterface;

/**
 * Class NetworkHandler
 * @package Raylin666\Client\Handler
 */
class NetworkHandler implements NetworkInterface
{
    /**
     * 加密包格式
     */
    const PACK_FORMAT = 'N';

    /**
     * 解包偏移量
     */
    const UNPACK_OFFSET = 4;

    /**
     * 随机值 1
     */
    const RAND_VALUE_1 = 'nf3$f29#';

    /**
     * 随机值 2
     */
    const RAND_VALUE_2 = 'jF9C#28c3';

    /**
     * 网络传输加密
     * @param $data
     * @return mixed
     */
    public function encode($data)
    {
        // TODO: Implement encode() method.

        $data = json_encode($data);
        return pack(NetworkHandler::PACK_FORMAT, strlen($data)) . $data;
    }

    /**
     * 网络传输解密
     * @param $data
     * @return mixed
     */
    public function decode($data)
    {
        // TODO: Implement decode() method.

        if (! is_null($data)) {
            $len = unpack(
                sprintf(
                    '%s%s',
                    NetworkHandler::PACK_FORMAT,
                    NetworkHandler::RAND_VALUE_1
                ), $data)[NetworkHandler::RAND_VALUE_1];

            return json_decode(
                unpack(
                    sprintf(
                        'a*%s',
                        NetworkHandler::RAND_VALUE_2
                    ),
                    substr(
                        $data,
                        NetworkHandler::UNPACK_OFFSET,
                        $len
                    ))[NetworkHandler::RAND_VALUE_2],
                true
            );
        }
    }
}