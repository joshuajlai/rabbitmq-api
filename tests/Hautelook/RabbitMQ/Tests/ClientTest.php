<?php

namespace Hautelook\RabbitMQ\Tests;

use Guzzle\Plugin\Mock\MockPlugin;
use Hautelook\RabbitMQ\Client;
use Hautelook\RabbitMQ\Model\Consumer;
use Hautelook\RabbitMQ\Model\ExchangeType;
use Hautelook\RabbitMQ\Model\Listener;
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

        $this->assertEquals('3.3.5', $response->getManagementVersion());
        $this->assertEquals('fine', $response->getStatisticsLevel());
        $this->assertCount(4, $response->getExchangeTypes());
        foreach ($response->getExchangeTypes() as $exchangeType) {
            $this->verifyExchangeType($exchangeType);
        }
        $this->assertEquals('3.3.5', $response->getRabbitmqVersion());
        $this->assertEquals('rabbit@munich.localdomain', $response->getClusterName());
        $this->assertEquals('R14B04', $response->getErlangVersion());
        $this->assertEquals(
            'Erlang R14B04 (erts-5.8.5) [source] [64-bit] [smp:2:2] [rq:2] [async-threads:30] [kernel-poll:true]',
            $response->getErlangFullVersion()
        );
        $this->assertEquals(1, $response->getMessagesCount());
        $this->assertEquals(0, $response->getMessagesRate());
        $this->assertEquals(1, $response->getMessagesReadyCount());
        $this->assertEquals(0, $response->getMessagesReadyRate());
        $this->assertEquals(0, $response->getMessagesUnacknowledgedCount());
        $this->assertEquals(0, $response->getMessagesUnacknowledgedRate());

        $this->assertEquals(1, $response->getPublishedCount());
        $this->assertEquals(0, $response->getPublishRate());
        $this->assertEquals(1, $response->getConfirmedCount());
        $this->assertEquals(0, $response->getConfirmRate());

        $this->assertEquals(0, $response->getConsumerCount());
        $this->assertEquals(2, $response->getQueueCount());
        $this->assertEquals(10, $response->getExchangeCount());
        $this->assertEquals(0, $response->getConnectionCount());
        $this->assertEquals(0, $response->getChannelCount());

        $this->assertEquals('rabbit@seville', $response->getNodeName());
        $this->assertEquals('rabbit@munich', $response->getStatisticsNodeName());

        $this->assertCount(6, $response->getListeners());
        foreach ($response->getListeners() as $listener) {
            $this->verifyListener($listener);
        }
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

    private function verifyExchangeType(ExchangeType $exchangeType)
    {
        $this->assertTrue(in_array($exchangeType->getName(), ExchangeType::getValidExchangeNames()));
        $this->assertTrue($exchangeType->isEnabled());
        $this->assertNotEmpty($exchangeType->getDescription());
    }

    private function verifyConsumer(Consumer $consumer)
    {
        $this->assertStringStartsWith('PHPPROCESS_prod-searchetl', $consumer->getConsumerTag());
        $this->assertInternalType('bool', $consumer->isExclusive());
        $this->assertInternalType('integer', $consumer->getPrefetchCount());
        $this->assertNotEmpty($consumer->getQueueName());
        $this->assertNotEmpty($consumer->getQueueVhost());
        $this->assertEquals([], $consumer->getArguments());
        $this->assertTrue($consumer->isAckRequired());
    }

    private function verifyListener(Listener $listener)
    {
        $this->assertTrue(in_array($listener->getNode(), ['rabbit@seville', 'rabbit@munich']));
        $this->assertTrue(in_array($listener->getProtocol(), Listener::getValidProtocols()));
        $this->assertEquals('::', $listener->getIpAddress());
        $this->assertInternalType('integer', $listener->getPort());
    }
}
