<?php

namespace Hautelook\RabbitMQ\Model;

use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Command\ResponseClassInterface;

class Overview implements ResponseClassInterface
{
    /**
     * @var string
     */
    private $clusterName;

    /**
     * @var string
     */
    private $managementVersion;

    /**
     * @var string
     */
    private $rabbitmqVersion;

    /**
     * @var string
     */
    private $erlangVersion;

    /**
     * @var int
     */
    private $consumerCount;

    /**
     * @var int
     */
    private $queueCount;

    /**
     * @var int
     */
    private $exchangeCount;

    /**
     * @var int
     */
    private $connectionCount;

    /**
     * @var int
     */
    private $channelCount;

    /**
     * @var int
     */
    private $publishCount;

    /**
     * @var float
     */
    private $publishRate;

    /**
     * @var int
     */
    private $ackCount;

    /**
     * @var float
     */
    private $ackRate;

    /**
     * @var int
     */
    private $deliverGetCount;

    /**
     * @var float
     */
    private $deliverGetRate;

    /**
     * @var int
     */
    private $redeliverCount;

    /**
     * @var float
     */
    private $redeliverRate;

    /**
     * @var int
     */
    private $deliverCount;

    /**
     * @var float
     */
    private $deliverRate;

    /**
     * @var int
     */
    private $messageCount;

    /**
     * @var float
     */
    private $messageRate;

    /**
     * @var int
     */
    private $messageReadyCount;

    /**
     * @var float
     */
    private $messageReadyRate;

    /**
     * @var int
     */
    private $messageUnacknowledgedCount;

    /**
     * @var float
     */
    private $messageUnacknowledgedRate;


    public static function fromCommand(OperationCommand $command)
    {
        $response = json_decode($command->getResponse()->getBody(true), true);

        $overview = new self();
        $overview->setClusterName($response['cluster_name']);
        $overview->setManagementVersion($response['management_version']);
        $overview->setRabbitmqVersion($response['rabbitmq_version']);
        $overview->setErlangVersion($response['erlang_version']);

        $overview->setConsumerCount($response['object_totals']['consumers']);
        $overview->setQueueCount($response['object_totals']['queues']);
        $overview->setExchangeCount($response['object_totals']['exchanges']);
        $overview->setConnectionCount($response['object_totals']['connections']);
        $overview->setChannelCount($response['object_totals']['channels']);

        $overview->setPublishCount($response['message_stats']['publish']);
        $overview->setPublishRate($response['message_stats']['publish_details']['rate']);

        $overview->setAckCount($response['message_stats']['ack']);
        $overview->setAckRate($response['message_stats']['ack_details']['rate']);

        $overview->setDeliverGetCount($response['message_stats']['deliver_get']);
        $overview->setDeliverGetRate($response['message_stats']['deliver_get_details']['rate']);

        $overview->setRedeliverCount($response['message_stats']['redeliver']);
        $overview->setRedeliverRate($response['message_stats']['redeliver_details']['rate']);

        $overview->setDeliverCount($response['message_stats']['deliver']);
        $overview->setDeliverRate($response['message_stats']['deliver_details']['rate']);

        $overview->setMessageCount($response['queue_totals']['messages']);
        $overview->setMessageRate($response['queue_totals']['messages_details']['rate']);

        $overview->setMessageReadyCount($response['queue_totals']['messages_ready']);
        $overview->setMessageReadyRate($response['queue_totals']['messages_ready_details']['rate']);

        $overview->setMessageUnacknowledgedCount($response['queue_totals']['messages_unacknowledged']);
        $overview->setMessageUnacknowledgedRate($response['queue_totals']['messages_unacknowledged_details']['rate']);

        return $overview;
    }

    /**
     * @return int
     */
    public function getMessageCount()
    {
        return $this->messageCount;
    }

    /**
     * @param int $messageCount
     */
    public function setMessageCount($messageCount)
    {
        $this->messageCount = $messageCount;
    }

    /**
     * @return float
     */
    public function getMessageRate()
    {
        return $this->messageRate;
    }

    /**
     * @param float $messageRate
     */
    public function setMessageRate($messageRate)
    {
        $this->messageRate = $messageRate;
    }

    /**
     * @return int
     */
    public function getMessageReadyCount()
    {
        return $this->messageReadyCount;
    }

    /**
     * @param int $messageReadyCount
     */
    public function setMessageReadyCount($messageReadyCount)
    {
        $this->messageReadyCount = $messageReadyCount;
    }

    /**
     * @return float
     */
    public function getMessageReadyRate()
    {
        return $this->messageReadyRate;
    }

    /**
     * @param float $messageReadyRate
     */
    public function setMessageReadyRate($messageReadyRate)
    {
        $this->messageReadyRate = $messageReadyRate;
    }

    /**
     * @return int
     */
    public function getMessageUnacknowledgedCount()
    {
        return $this->messageUnacknowledgedCount;
    }

    /**
     * @param int $messageUnacknowledgedCount
     */
    public function setMessageUnacknowledgedCount($messageUnacknowledgedCount)
    {
        $this->messageUnacknowledgedCount = $messageUnacknowledgedCount;
    }

    /**
     * @return float
     */
    public function getMessageUnacknowledgedRate()
    {
        return $this->messageUnacknowledgedRate;
    }

    /**
     * @param float $messageUnacknowledgedRate
     */
    public function setMessageUnacknowledgedRate($messageUnacknowledgedRate)
    {
        $this->messageUnacknowledgedRate = $messageUnacknowledgedRate;
    }

    /**
     * @return int
     */
    public function getAckCount()
    {
        return $this->ackCount;
    }

    /**
     * @param int $ackCount
     */
    public function setAckCount($ackCount)
    {
        $this->ackCount = $ackCount;
    }

    /**
     * @return float
     */
    public function getAckRate()
    {
        return $this->ackRate;
    }

    /**
     * @param float $ackRate
     */
    public function setAckRate($ackRate)
    {
        $this->ackRate = $ackRate;
    }

    /**
     * @return int
     */
    public function getDeliverCount()
    {
        return $this->deliverCount;
    }

    /**
     * @param int $deliverCount
     */
    public function setDeliverCount($deliverCount)
    {
        $this->deliverCount = $deliverCount;
    }

    /**
     * @return int
     */
    public function getDeliverGetCount()
    {
        return $this->deliverGetCount;
    }

    /**
     * @param int $deliverGetCount
     */
    public function setDeliverGetCount($deliverGetCount)
    {
        $this->deliverGetCount = $deliverGetCount;
    }

    /**
     * @return float
     */
    public function getDeliverGetRate()
    {
        return $this->deliverGetRate;
    }

    /**
     * @param float $deliverGetRate
     */
    public function setDeliverGetRate($deliverGetRate)
    {
        $this->deliverGetRate = $deliverGetRate;
    }

    /**
     * @return float
     */
    public function getDeliverRate()
    {
        return $this->deliverRate;
    }

    /**
     * @param float $deliverRate
     */
    public function setDeliverRate($deliverRate)
    {
        $this->deliverRate = $deliverRate;
    }

    /**
     * @return int
     */
    public function getPublishCount()
    {
        return $this->publishCount;
    }

    /**
     * @param int $publishCount
     */
    public function setPublishCount($publishCount)
    {
        $this->publishCount = $publishCount;
    }

    /**
     * @return float
     */
    public function getPublishRate()
    {
        return $this->publishRate;
    }

    /**
     * @param float $publishRate
     */
    public function setPublishRate($publishRate)
    {
        $this->publishRate = $publishRate;
    }

    /**
     * @return int
     */
    public function getRedeliverCount()
    {
        return $this->redeliverCount;
    }

    /**
     * @param int $redeliverCount
     */
    public function setRedeliverCount($redeliverCount)
    {
        $this->redeliverCount = $redeliverCount;
    }

    /**
     * @return float
     */
    public function getRedeliverRate()
    {
        return $this->redeliverRate;
    }

    /**
     * @param float $redeliverRate
     */
    public function setRedeliverRate($redeliverRate)
    {
        $this->redeliverRate = $redeliverRate;
    }



    /**
     * @return int
     */
    public function getChannelCount()
    {
        return $this->channelCount;
    }

    /**
     * @param int $channelCount
     */
    public function setChannelCount($channelCount)
    {
        $this->channelCount = $channelCount;
    }

    /**
     * @return int
     */
    public function getConnectionCount()
    {
        return $this->connectionCount;
    }

    /**
     * @param int $connectionCount
     */
    public function setConnectionCount($connectionCount)
    {
        $this->connectionCount = $connectionCount;
    }

    /**
     * @return int
     */
    public function getConsumerCount()
    {
        return $this->consumerCount;
    }

    /**
     * @param int $consumerCount
     */
    public function setConsumerCount($consumerCount)
    {
        $this->consumerCount = $consumerCount;
    }

    /**
     * @return int
     */
    public function getExchangeCount()
    {
        return $this->exchangeCount;
    }

    /**
     * @param int $exchangeCount
     */
    public function setExchangeCount($exchangeCount)
    {
        $this->exchangeCount = $exchangeCount;
    }

    /**
     * @return int
     */
    public function getQueueCount()
    {
        return $this->queueCount;
    }

    /**
     * @param int $queueCount
     */
    public function setQueueCount($queueCount)
    {
        $this->queueCount = $queueCount;
    }



    /**
     * @return string
     */
    public function getClusterName()
    {
        return $this->clusterName;
    }

    /**
     * @param string $clusterName
     */
    public function setClusterName($clusterName)
    {
        $this->clusterName = $clusterName;
    }

    /**
     * @return string
     */
    public function getErlangVersion()
    {
        return $this->erlangVersion;
    }

    /**
     * @param string $erlangVersion
     */
    public function setErlangVersion($erlangVersion)
    {
        $this->erlangVersion = $erlangVersion;
    }

    /**
     * @return string
     */
    public function getManagementVersion()
    {
        return $this->managementVersion;
    }

    /**
     * @param string $managementVersion
     */
    public function setManagementVersion($managementVersion)
    {
        $this->managementVersion = $managementVersion;
    }

    /**
     * @return string
     */
    public function getRabbitmqVersion()
    {
        return $this->rabbitmqVersion;
    }

    /**
     * @param string $rabbitmqVersion
     */
    public function setRabbitmqVersion($rabbitmqVersion)
    {
        $this->rabbitmqVersion = $rabbitmqVersion;
    }
} 
