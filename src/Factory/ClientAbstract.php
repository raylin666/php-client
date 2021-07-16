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

use Throwable;
use InvalidArgumentException;
use Raylin666\Client\Contract\SwooleClientInterface;
use Swoole\Client;

/**
 * Class ClientAbstract
 * @package Raylin666\Client\Factory
 */
abstract class ClientAbstract implements SwooleClientInterface
{
    /**
     * @var Client|\Swoole\Coroutine\Client
     */
    protected $client;

    /**
     * ClientAbstract constructor.
     * @param int $sock_type
     */
    abstract public function __construct(int $sock_type);

    /**
     * 设置客户端参数 (必须在 connect 前调用)
     * @param array $settings
     * @return mixed
     */
    public function set(array $settings)
    {
        // TODO: Implement set() method.

        return $this->client->set($settings);
    }

    /**
     * 连接客户端
     * @param string $host
     * @param int    $port
     * @param float  $timeout
     * @return bool
     */
    public function connect(string $host, int $port, $timeout = 0.5): bool
    {
        // TODO: Implement connect() method.

        if ($port < 1 || $port > 65535) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid port "%d" specified; must be a valid TCP/UDP port',
                    $port
                )
            );
        }

        return $this->client->connect($host, $port, $timeout);
    }

    /**
     * 是否已连接客户都
     * @return bool
     */
    public function isConnected(): bool
    {
        // TODO: Implement isConnected() method.

        return $this->client->isConnected();
    }

    public function getSocket()
    {
        // TODO: Implement getSocket() method.

        return $this->client->getSocket();
    }

    public function getsockname()
    {
        // TODO: Implement getsockname() method.

        return $this->client->getsockname();
    }

    public function getpeername()
    {
        // TODO: Implement getpeername() method.

        return $this->client->getpeername();
    }

    /**
     * 获取服务器端证书信息 (必须在 SSL 握手完成后才可以调用此方法)
     * @return false|mixed|string
     */
    public function getPeerCert()
    {
        // TODO: Implement getPeerCert() method.

        try {
            return $this->client->getPeerCert();
        } catch (Throwable $e) {
            return false;
        }
    }

    /**
     * 验证服务器端证书
     * @return bool|mixed
     */
    public function verifyPeerCert()
    {
        // TODO: Implement verifyPeerCert() method.

        try {
            return $this->client->verifyPeerCert();
        } catch (Throwable $e) {
            return false;
        }
    }

    public function send(string $data)
    {
        // TODO: Implement send() method.

        return $this->client->send($data);
    }

    public function sendto(string $ip, int $port, string $data): bool
    {
        // TODO: Implement sendto() method.

        return $this->client->sendto($ip, $port, $data);
    }

    public function sendfile(string $filename, int $offset = 0, int $length = 0): bool
    {
        // TODO: Implement sendfile() method.

        return $this->client->sendfile($filename, $offset, $length);
    }

    /**
     * 从服务器端接收数据
     * @param int $size
     * @param int $flags
     * @return false|mixed|string
     */
    public function recv(int $size = 65535, int $flags = 0)
    {
        // TODO: Implement recv() method.

        return $this->client->recv($size, $flags);
    }

    /**
     * 关闭连接
     * @param bool $force
     * @return bool
     */
    public function close(bool $force = false): bool
    {
        // TODO: Implement close() method.

        return $this->client->close();
    }

    /**
     * 动态开启 SSL 隧道加密
     * @return bool
     */
    public function enableSSL(): bool
    {
        // TODO: Implement enableSSL() method.

        try {
            return $this->client->enableSSL();
        } catch (Throwable $e) {
            return false;
        }
    }

    /**
     * 错误码
     * @return int
     */
    public function errCode(): int
    {
        // TODO: Implement errCode() method.

        return $this->client->errCode;
    }
}