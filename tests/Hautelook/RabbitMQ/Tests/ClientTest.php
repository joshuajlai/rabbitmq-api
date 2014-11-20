<?php

namespace Hautelook\RabbitMQ\Tests;

use Guzzle\Plugin\Mock\MockPlugin;
use Hautelook\RabbitMQ\Client;
use Hautelook\RabbitMQ\Model\Overview;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testGetOverview()
    {
        $client = new Client();

        $mock = new MockPlugin();
        $mock->addResponse(__DIR__ . '/fixtures/get-overview');
        $client->addGuzzlePlugin($mock);

        $response = $client->getOverview();

        $this->assertInstanceOf(Overview::class, $response);
        $this->assertEquals('rabbit@munich.localdomain', $response->getClusterName());
    }
}
