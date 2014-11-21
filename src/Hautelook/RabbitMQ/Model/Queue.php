<?php

namespace Hautelook\RabbitMQ\Model;

/**
 * Not yet Implemented:
 * [15] => backing_queue_status
 * [17] => incoming
 * [18] => deliveries
 *
 * @author Baldur Rensch <brensch@gmail.com>
 */
class Queue extends AbstractRabbitMQModel
{
    use MessageStatsTrait, MessagesTrait;

    public function getMemory()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[memory]');
    }

    public function getConsumerUtilisation()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[consumer_utilisation]');
    }

    public function getIdleSince()
    {
        return new \DateTime($this->getPropertyAccessor()->getValue($this->data, '[idle_since]'));
    }

    public function getPolicy()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[policy]');
    }

    public function getConsumerCount()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[consumers]');
    }

    public function getExclusiveConsumerTag()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[exclusive_consumer_tag]');
    }

    public function getSlaveNodes()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[slave_nodes]');
    }

    public function getSynchronizedSlaveNodes()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[synchronised_slave_nodes]');
    }

    public function getState()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[state]');
    }

    /**
     * @return Consumer[]
     */
    public function getConsumers()
    {
        $consumers = [];
        foreach ($this->getPropertyAccessor()->getValue($this->data, '[consumer_details]') as $consumerData) {
            $consumers[] = new Consumer($consumerData);
        }

        return $consumers;
    }

    public function getQueueName()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[name]');
    }

    public function getQueueVhost()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[vhost]');
    }

    public function isDurable()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[durable]');
    }

    public function isAutoDeleted()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[auto_delete]');
    }

    public function getArguments()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[arguments]');
    }

    public function getNode()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[node]');
    }

    protected function getMessagesTraitPrefix()
    {
        return '';
    }
}
