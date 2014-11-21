<?php

namespace Hautelook\RabbitMQ\Model;

trait MessagesTrait
{
    use AbstractRabbitMQTrait;

    abstract protected function getMessagesTraitPrefix();

    public function getMessagesCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), $this->getMessagesTraitPrefix() . '[messages]');
    }

    public function getMessagesRate()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), $this->getMessagesTraitPrefix() . '[messages_details][rate]');
    }

    public function getMessagesReadyCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), $this->getMessagesTraitPrefix() . '[messages_ready]');
    }

    public function getMessagesReadyRate()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), $this->getMessagesTraitPrefix() . '[messages_ready_details][rate]');
    }

    public function getMessagesUnacknowledgedCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), $this->getMessagesTraitPrefix() . '[messages_unacknowledged]');
    }

    public function getMessagesUnacknowledgedRate()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), $this->getMessagesTraitPrefix() . '[messages_unacknowledged_details][rate]');
    }
} 
