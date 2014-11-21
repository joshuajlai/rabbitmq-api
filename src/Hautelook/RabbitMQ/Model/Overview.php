<?php

namespace Hautelook\RabbitMQ\Model;

use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Command\ResponseClassInterface;

/**
 * Not yet implemented:
 * - contexts
 *
 * @author Baldur Rensch <brensch@gmail.com>
 */
class Overview extends AbstractRabbitMQModel
{
    use MessageStatsTrait, MessagesTrait;

    public function getManagementVersion()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[management_version]');
    }

    public function getStatisticsLevel()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[statistics_level]');
    }

    public function getExchangeTypes()
    {
        $exchangeTypes = [];
        foreach ($this->getPropertyAccessor()->getValue($this->data, '[exchange_types]') as $exchangeData) {
            $exchangeTypes[] = new ExchangeType($exchangeData);
        }

        return $exchangeTypes;
    }

    public function getRabbitmqVersion()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[rabbitmq_version]');
    }

    public function getClusterName()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[cluster_name]');
    }

    public function getErlangVersion()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[erlang_version]');
    }

    public function getErlangFullVersion()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[erlang_full_version]');
    }

    public function getPublishedCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[message_stats][publish]');
    }

    public function getPublishRate()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[message_stats][publish_details][rate]');
    }

    public function getConfirmedCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[message_stats][confirm]');
    }

    public function getConfirmRate()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[message_stats][confirm_details][rate]');
    }

    public function getConsumerCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[object_totals][consumers]');
    }

    public function getQueueCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[object_totals][queues]');
    }

    public function getExchangeCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[object_totals][exchanges]');
    }

    public function getConnectionCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[object_totals][connections]');
    }

    public function getChannelCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[message_stats][channels]');
    }

    public function getNodeName()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[node]');
    }

    public function getStatisticsNodeName()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[statistics_db_node]');
    }

    public function getListeners()
    {
        $listeners = [];
        foreach ($this->getPropertyAccessor()->getValue($this->data, '[listeners]') as $listener) {
            $listeners[] = new Listener($listener);
        }

        return $listeners;
    }

    protected function getMessagesTraitPrefix()
    {
        return '[queue_totals]';
    }
} 
