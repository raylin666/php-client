# Swoole Client

[![GitHub release](https://img.shields.io/github/release/raylin666/php-client.svg)](https://github.com/raylin666/php-client/releases)
[![PHP version](https://img.shields.io/badge/php-%3E%207.3-orange.svg)](https://github.com/php/php-src)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](#LICENSE)

### 环境要求

* PHP >=7.3

### 安装说明

```
composer require "raylin666/client"
```

### 使用方式

```php
<?php

require_once 'vendor/autoload.php';

go(function () {
    $client = new Raylin666\Client\Client;
    $swooleClient = $client()->getFactory()->getClient();

    $options = new \Raylin666\Client\Swoole\SwooleClientOptions;
    $swooleClient->set($options);

    $swooleClient->connect('127.0.0.1', 9903);
    $swooleClient->send(['a' => 'c']);
    $result = $swooleClient->recv();
    var_dump($result);
    $swooleClient->close();
});

\Swoole\Event::wait();
```

## 更新日志

请查看 [CHANGELOG.md](CHANGELOG.md)

### 联系

如果你在使用中遇到问题，请联系: [1099013371@qq.com](mailto:1099013371@qq.com). 博客: [kaka 梦很美](http://www.ls331.com)

## License MIT
