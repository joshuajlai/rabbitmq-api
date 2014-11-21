<?php

namespace Hautelook\RabbitMQ\Model;

use Symfony\Component\PropertyAccess\PropertyAccessor;

trait MessagesTrait
{
    /**
     * @return PropertyAccessor
     */
    abstract protected function getPropertyAccessor();

    /**
     * @return array
     */
    abstract protected function getData();

    public function getMessagesCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[messages]');
    }

    public function getMessagesRate()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[messages_details][rate]');
    }

    public function getMessagesReadyCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[messages_ready]');
    }

    public function getMessagesReadyRate()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[messages_ready_details][rate]');
    }

    public function getMessagesUnacknowledgedCount()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[messages_unacknowledged]');
    }

    public function getMessagesUnacknowledgedRate()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[messages_unacknowledged_details][rate]');
    }
} 
