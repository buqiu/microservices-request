# kafka

## 介绍
微服务 Http 请求系统扩展包。

## 环境
```
php >= 8.1
composer >= 2.0
```

## 使用
### 1.安装
```shell
composer require buqiu/microservices-request
```
### 2.发布 **_microservices.php_** 配置文件
```shell
php artisan vendor:publish --tag=buqiu-microservices-config
```
### 3.配置 .env 文件
```dotenv
MS_URI_PREFIX=URI 前缀
MS_USER=http://user_ms:8000
```
### 4.代码示例
#### 4.1 依赖注入方式
```php
use Buqiu\MicroservicesRequest\MicroservicesHttpService;

public function __construct(MicroservicesHttpService $microservicesHttpService)
{
    $this->microservicesHttpService = $microservicesHttpService;
}

public function index()
{
    $user = $this->microservicesHttpService->setEndpoint('user')->get('user');
}
```
#### 4.2 直接实例化方式
```php
use Buqiu\MicroservicesRequest\MicroservicesHttpService;

public function index()
{
    $user = app(MicroservicesHttpService::class)->setEndpoint('user')->get('user');
}

// 或

public function index()
{
    $user = app(MicroservicesHttpService::class, ['serviceName' => 'user'])->get('user');
}
```