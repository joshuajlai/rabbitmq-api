# RabbitMQ Management API

This library exposes the RabbitMQ Management API to PHP through Guzzle.

[![Build Status](https://travis-ci.org/hautelook/rabbitmq-api.svg)](https://travis-ci.org/hautelook/rabbitmq-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/hautelook/rabbitmq-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/hautelook/rabbitmq-api/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/hautelook/rabbitmq-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/hautelook/rabbitmq-api/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/95e7fbd3-7d50-45d0-aefb-84b546723bc2/mini.png)](https://insight.sensiolabs.com/projects/95e7fbd3-7d50-45d0-aefb-84b546723bc2)

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

### 2.2 Retrieving a queue
```php
$queue = $client->getQueue('/', 'my_queue_name');
print_r($queue);
```

## 3. Running tests

You can run the unit and functional tests for this library by running `phpunit` after installing 
the dependencies. 
