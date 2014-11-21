<?php

namespace Hautelook\RabbitMQ\Model;

trait ChannelDetailTrait
{
    use AbstractRabbitMQTrait;

    public function getChannelName()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[channel_details][name]');
    }

    public function getChannelNumber()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[channel_details][number]');
    }

    public function getConnectionName()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[channel_details][connection_name]');
    }

    public function getPeerPort()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[channel_details][peer_port]');
    }

    public function getPeerHost()
    {
        return $this->getPropertyAccessor()->getValue($this->getData(), '[channel_details][peer_host]');
    }
} 
