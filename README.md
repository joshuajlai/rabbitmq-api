# RabbitMQ Management API

This library exposes the RabbitMQ Management API to PHP through Guzzle.

## 1. Installation

1. Require the package via composer

```bash
$ composer require "hautelook/rabbitmq-api"
```

2. Instantiate the library:

```php
$client = new \Hautelook\RabbitMQ\Client(
    [
        'hostname' => 'localhost', // Default, don't have to pass this in
        'scheme' => 'https', // Default, don't have to pass this in
        'port' => 8080, // Default, don't have to pass this in
        'username' => 'guest', // Default, don't have to pass this in
        'password' => 'guest', // Default, don't have to pass this in
        'ssl' => true // Default, don't have to pass this in
    ]
);
```

## 2. Usage

### 2.1 Getting an overview

```php
$overview = $client->getOverview();
print_r($overview);
```

## 3. Running tests

You can run the unit and functional tests for this library by running `phpunit` after installing 
the dependencies. 
