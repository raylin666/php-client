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

use Exception;
use Raylin666\Client\Exception\ConnectionException;
use Raylin666\Client\Handler\NetworkHandler;
use Raylin666\Utils\Coroutine\Coroutine;
use Throwable;
use InvalidArgumentException;
use Swoole\Client;
use Raylin666\Client\Contract\NetworkInterface;
use Raylin666\Client\Contract\SwooleClientInterface;
use Raylin666\Client\Swoole\SwooleClientOptions;

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
     * @var null|NetworkInterface
     */
    protected $network;

    /**
     * @var SwooleClientOptions|null
     */
    protected $options;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var float
     */
    protected $timeout;

    /**
     * @var int
     */
    protected $retry = 5;

    /**
     * ClientAbstract constructor.
     * @param int $sock_type
     */
    public function __construct(int $sock_type)
    {
        $this->__initialize($sock_type);

        $this->network = new NetworkHandler();
    }

    /**
     * @param int $sock_type
     * @return mixed
     */
    abstract public function __initialize(int $sock_type);

    /**
     * 设置客户端参数 (必须在 connect 前调用)
     * @param SwooleClientOptions $options
     * @return mixed
     */
    public function set(SwooleClientOptions $options)
    {
        // TODO: Implement set() method.

        $this->options = $options;
        return $this->client->set($options->toArray());
    }

    /**
     * 连接客户端
     * @param string $host
     * @param int    $port
     * @param float  $timeout
     * @return bool
     */
    public function connect(string $host, int $port, $timeout = 5.0): bool
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

        $this->host = $host;
        $this->port = $port;
        $this->timeout = $timeout;
        return $this->client->connect($host, $port, $timeout);
    }

    /**
     * 是否已连接客户端
     * @return bool
     */
    public function isConnected(): bool
    {
        // TODO: Implement isConnected() method.

        return $this->client->isConnected();
    }

    /**
     * 获取底层的 socket 句柄，返回的对象为 sockets 资源句柄
     * @return mixed
     */
    public function getSocket()
    {
        // TODO: Implement getSocket() method.

        return $this->client->getSocket();
    }

    /**
     * 用于获取客户端 socket 的本地 host:port
     * @return array|false|mixed
     */
    public function getsockname()
    {
        // TODO: Implement getsockname() method.

        return $this->client->getsockname();
    }

    /**
     * 获取对端 socket 的 IP 地址和端口
     * @return array|false|mixed
     */
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

    /**
     * 重连客户端
     * @return bool
     * @throws ConnectionException
     */
    public function reconnect(): bool
    {
        if (! $this->isConnected()) {
            for ($i = 0; $i < $this->retry; $i++) {
                $isConnected = $this->connect($this->host, $this->port, $this->timeout);
                if ($isConnected) {
                    break;
                }
            }
        }

        if (! $this->isConnected()) {
            throw new ConnectionException('Reconnect client error');
        }

        return true;
    }

    /**
     * 发送数据到远程服务器，必须在建立连接后，才可向对端发送数据
     * @param $data
     * @return false|int|mixed
     */
    public function send($data)
    {
        // TODO: Implement send() method.

        $this->reconnect();
        return $this->client->send($this->dataEncode($data));
    }

    /**
     * 向任意 IP:PORT 的主机发送 UDP 数据包，仅支持 SWOOLE_SOCK_UDP/SWOOLE_SOCK_UDP6 类型
     * @param string $ip
     * @param int    $port
     * @param        $data
     * @return bool
     */
    public function sendto(string $ip, int $port, $data): bool
    {
        // TODO: Implement sendto() method.

        return $this->client->sendto($ip, $port, $this->dataEncode($data));
    }

    /**
     * 发送文件到服务器，本函数是基于 sendfile 操作系统调用实现
     * @param string $filename
     * @param int    $offset
     * @param int    $length
     * @return bool
     */
    public function sendfile(string $filename, int $offset = 0, int $length = 0): bool
    {
        // TODO: Implement sendfile() method.

        $this->reconnect();
        return $this->client->sendfile($filename, $offset, $length);
    }

    /**
     * 从服务器端接收数据
     * @param int $size
     * @param int $flags
     * @param float $timeout
     * @return false|mixed|string
     */
    public function recv(int $size = 65535, int $flags = 0, float $timeout = 0)
    {
        // TODO: Implement recv() method.

        if (Coroutine::inCoroutine()) {
            $data = $this->client->recv($timeout);
        } else {
            $data = $this->client->recv($size, $flags);
        }

        if ($data === '') {
            $this->close();
            throw new ConnectionException('Service connect close');
        }

        if ($data === false) {
            // 如果超时时则不关闭连接，其他情况直接关闭连接
            if ($this->errCode() !== SOCKET_ETIMEDOUT) {
                $this->close();
                throw new ConnectionException('Recv data error - ' . swoole_strerror($this->errCode(), 9), $this->errCode());
            } else {
                throw new ConnectionException('Recv data timeout - ' . swoole_strerror($this->errCode(), 9), $this->errCode());
            }
        }

        return $this->dataDecode($data);
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

    /**
     * 获取客户端参数配置项
     * @return SwooleClientOptions|null
     */
    public function getSwooleClientOptions(): ?SwooleClientOptions
    {
        return $this->options;
    }

    /**
     * 设置网络传输
     * @param NetworkInterface|null $network
     * @return SwooleClientInterface
     */
    public function withNetWorkHandler(?NetworkInterface $network): SwooleClientInterface
    {
        // TODO: Implement withNetWorkHandler() method.

        $this->network = $network;
        return $this;
    }

    /**
     * @param $data
     * @return mixed
     */
    protected function dataEncode($data)
    {
        return $this->network ? $this->network->encode($data) : $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    protected function dataDecode($data)
    {
        return $this->network ? $this->network->decode($data) : $data;
    }
}