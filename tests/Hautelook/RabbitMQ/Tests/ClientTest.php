<?php

namespace Hautelook\RabbitMQ\Tests;

use Guzzle\Plugin\Mock\MockPlugin;
use Hautelook\RabbitMQ\Client;
use Hautelook\RabbitMQ\Model\Consumer;
use Hautelook\RabbitMQ\Model\Overview;
use Hautelook\RabbitMQ\Model\Queue;

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

    public function testGetQueue()
    {
        $client = new Client();

        $mock = new MockPlugin();
        $mock->addResponse(__DIR__ . '/fixtures/get-queue');
        $client->addGuzzlePlugin($mock);

        $response = $client->getQueue('/', 'testqueue');
        $this->assertInstanceOf(Queue::class, $response);

        $this->assertEquals(17568, $response->getMemory());
        $this->assertEquals('', $response->getConsumerUtilisation());
        $this->assertEquals(new \DateTime('2014-11-21 00:48:25'), $response->getIdleSince());
        $this->assertEquals('HA', $response->getPolicy());
        $this->assertEquals(4, $response->getConsumerCount());
        $this->assertEquals('', $response->getExclusiveConsumerTag());
        $this->assertEquals(['rabbit@cookie', 'rabbit@cupcake'], $response->getSlaveNodes());
        $this->assertEquals(['rabbit@cupcake', 'rabbit@cookie'], $response->getSynchronizedSlaveNodes());
        $this->assertEquals('running', $response->getState());

        $this->assertCount(4, $response->getConsumers());
        foreach ($response->getConsumers() as $consumer) {
            $this->verifyConsumer($consumer);
        }

        $this->assertEquals('datawarehouse_update_sku_saleability', $response->getQueueName());
        $this->assertEquals('/', $response->getQueueVhost());
        $this->assertEquals(true, $response->isDurable());
        $this->assertEquals(false, $response->isAutoDeleted());
        $this->assertEquals([], $response->getArguments());
        $this->assertEquals('rabbit@scone', $response->getNode());

        $this->assertEquals(1293437, $response->getAckCount());
    }

    private function verifyConsumer(Consumer $consumer)
    {
        $this->assertStringStartsWith('PHPPROCESS_prod-searchetl', $consumer->getConsumerTag());
        $this->assertEquals([], $consumer->getArguments());
        $this->assertTrue($consumer->isAckRequired());
    }
}
