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
 * Interface SwooleClientInterface
 * @package Raylin666\Client\Contract
 */
interface SwooleClientInterface
{
    /**
     * 设置客户端参数 (必须在 connect 前调用)
     * @param array $settings
     */
    public function set(array $settings);

    /**
     * 连接客户端
     * @param string $host
     * @param int    $port
     * @param float  $timeout
     * @return bool
     */
    public function connect(string $host, int $port, $timeout = 0.5): bool;

    /**
     * 是否已连接客户端
     * @return bool
     */
    public function isConnected(): bool;

    /**
     * 获取底层的 socket 句柄，返回的对象为 sockets 资源句柄
     * @return mixed
     */
    public function getSocket();

    /**
     * 用于获取客户端 socket 的本地 host:port
     * @return array|false
     */
    public function getsockname();

    /**
     * 获取对端 socket 的 IP 地址和端口
     * @return array|false
     */
    public function getpeername();

    /**
     * 获取服务器端证书信息 (必须在 SSL 握手完成后才可以调用此方法)
     * @return string|false
     */
    public function getPeerCert();

    /**
     * 验证服务器端证书
     * @return mixed
     */
    public function verifyPeerCert();

    /**
     * 发送数据到远程服务器，必须在建立连接后，才可向对端发送数据
     * @param string $data
     * @return int|false
     */
    public function send(string $data);

    /**
     * 向任意 IP:PORT 的主机发送 UDP 数据包，仅支持 SWOOLE_SOCK_UDP/SWOOLE_SOCK_UDP6 类型
     * @param string $ip
     * @param int $port
     * @param string $data
     * @return bool
     */
    public function sendto(string $ip, int $port, string $data): bool;

    /**
     * 发送文件到服务器，本函数是基于 sendfile 操作系统调用实现
     * @return bool
     */
    public function sendfile(string $filename, int $offset = 0, int $length = 0): bool;

    /**
     * 从服务器端接收数据
     * @param int $size
     * @param int $flags
     * @return string|false
     */
    public function recv(int $size = 65535, int $flags = 0);

    /**
     * 关闭连接
     * @param bool $force
     * @return bool
     */
    public function close(bool $force = false): bool;

    /**
     * 动态开启 SSL 隧道加密
     * @return bool
     */
    public function enableSSL(): bool;

    /**
     * 错误码
     * @return int
     */
    public function errCode(): int;
}