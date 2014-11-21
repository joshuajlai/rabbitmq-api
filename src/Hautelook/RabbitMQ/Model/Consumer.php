<?php

namespace Hautelook\RabbitMQ\Model;

class Consumer extends AbstractRabbitMQModel
{
    use ChannelDetailTrait;

    public function getConsumerTag()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[consumer_tag]');
    }

    public function isExclusive()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[exclusive]');
    }

    public function isAckRequired()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[ack_required]');
    }

    public function getPrefetchCount()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[prefetch_count]');
    }

    public function getArguments()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[arguments]');
    }

    public function getQueueName()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[queue][name]');
    }

    public function getQueueVhost()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[queue][vhost]');
    }
} 
