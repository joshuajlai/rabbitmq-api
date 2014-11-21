<?php

namespace Hautelook\RabbitMQ\Model;

trait MessageStatsTrait
{
    use AbstractRabbitMQTrait;

    public function getAckCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[message_stats][ack]');
    }

    public function getAckRate()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[message_stats][ack_details][rate]');
    }

    public function getDeliverCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[message_stats][deliver]');
    }

    public function getDeliverRate()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[message_stats][deliver_details][rate]');
    }

    public function getDeliverGetCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[message_stats][deliver_get]');
    }

    public function getDeliverGetRate()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[message_stats][deliver_get_details][rate]');
    }

    public function getPublishCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[message_stats][publish]');
    }

    public function getPublishRate()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[message_stats][publish_details][rate]');
    }

    public function getRedeliverCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[message_stats][redeliver]');
    }

    public function getRedeliverRate()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[message_stats][redeliver_details][rate]');
    }
} 
