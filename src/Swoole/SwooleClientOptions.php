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

use Raylin666\Client\Handler\NetworkHandler;

/**
 * Class SwooleClientOptions
 * @package Raylin666\Client\Swoole
 */
class SwooleClientOptions
{
    /**
     * 总超时，包括连接、发送、接收所有超时
     * @var float
     */
    protected $timeout = 5.0;

    /**
     * 连接超时，会覆盖总超时
     * @var float
     */
    protected $connect_timeout = 5.0;

    /**
     * 发送超时，会覆盖总超时
     * @var float
     */
    protected $write_timeout = 5.0;

    /**
     * 接收超时，会覆盖总超时
     * @var float
     */
    protected $read_timeout = 5.0;

    /**
     * 结束符检测
     * @var array
     */
    protected $eof_check = [
        'open_eof_check' => false,   // 打开 EOF 检测
        'open_eof_split' => false,   // 启用 EOF 自动分包
        'package_eof' => '\r\n',     // 设置 EOF , 设置后包头会以该内容结尾作为数据包返回
    ];

    /**
     * 长度检测
     * @var array
     */
    protected $length_check = [
        'open_length_check' => true,    // 打开包长检测
        'package_length_type' => NetworkHandler::PACK_FORMAT,    // 无符号、网络字节序、4 字节
        'package_length_offset' => 0,    // 第 N 个字节是包长度的值
        'package_body_offset' => NetworkHandler::UNPACK_OFFSET,  // 第几个字节开始计算长度
        'package_max_length' => 2 * 1024 * 1024,    // 最大数据包尺寸，单位为字节, 默认 2M
    ];

    /**
     * @var array
     */
    protected $other_options = [];

    /**
     * @param float $timeout
     * @return SwooleClientOptions
     */
    public function withTimeout(float $timeout): SwooleClientOptions
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @return float
     */
    public function getTimeout(): float
    {
        return $this->timeout;
    }

    /**
     * @param float $timeout
     * @return SwooleClientOptions
     */
    public function withConnectTimeout(float $timeout): SwooleClientOptions
    {
        $this->connect_timeout = $timeout;
        return $this;
    }

    /**
     * @return float
     */
    public function getConnectTimeout(): float
    {
        return $this->connect_timeout;
    }

    /**
     * @param float $timeout
     * @return SwooleClientOptions
     */
    public function withWriteTimeout(float $timeout): SwooleClientOptions
    {
        $this->write_timeout = $timeout;
        return $this;
    }

    /**
     * @return float
     */
    public function getWriteTimeout(): float
    {
        return $this->write_timeout;
    }

    /**
     * @param float $timeout
     * @return SwooleClientOptions
     */
    public function withReadTimeout(float $timeout): SwooleClientOptions
    {
        $this->read_timeout = $timeout;
        return $this;
    }

    /**
     * @return float
     */
    public function getReadTimeout(): float
    {
        return $this->read_timeout;
    }

    /**
     * @param bool $open_eof_check
     * @param      $package_eof
     * @return SwooleClientOptions
     */
    public function withEofCheck(bool $open_eof_check, $package_eof = '\r\n'): SwooleClientOptions
    {
        $this->eof_check['open_eof_check'] = $open_eof_check;
        $this->eof_check['package_eof'] = $package_eof;
        return $this;
    }

    /**
     * @return array
     */
    public function getEofCheck(): array
    {
        return $this->eof_check;
    }

    /**
     * @param bool   $open_length_check
     * @param string $package_length_type
     * @param int    $package_length_offset
     * @param int    $package_body_offset
     * @param int    $package_max_length
     * @return SwooleClientOptions
     */
    public function withLengthCheck(
        bool $open_length_check,
        $package_length_type = 'N',
        $package_length_offset = 0,
        $package_body_offset = 0,
        int $package_max_length = 2 * 1024 * 1024
    ): SwooleClientOptions
    {
        $this->length_check['open_length_check'] = $open_length_check;
        $this->length_check['package_length_type'] = $package_length_type;
        $this->length_check['package_length_offset'] = $package_length_offset;
        $this->length_check['package_body_offset'] = $package_body_offset;
        $this->length_check['package_max_length'] = $package_max_length;
        return $this;
    }

    /**
     * @return array
     */
    public function getLengthCheck(): array
    {
        return $this->length_check;
    }

    /**
     * @param array $options
     * @return SwooleClientOptions
     */
    public function withOtherOptions(array $options): SwooleClientOptions
    {
        $this->other_options = $options;
        return $this;
    }

    /**
     * @return array
     */
    public function getOtherOptions(): array
    {
        return $this->other_options;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(
            [
                'timeout' => $this->timeout,
                'connect_timeout' => $this->connect_timeout,
                'write_timeout' => $this->write_timeout,
                'read_timeout' => $this->read_timeout,
            ],
            $this->eof_check,
            $this->length_check,
            $this->other_options
        );
    }
}