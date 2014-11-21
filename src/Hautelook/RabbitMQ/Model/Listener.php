<?php

namespace Hautelook\RabbitMQ\Model;

class Listener extends AbstractRabbitMQModel
{
    const PROTOCOL_AMQP = 'amqp';
    const PROTOCOL_AMQP_SSL = 'amqp/ssl';
    const PROTOCOL_CLUSTERING = 'clustering';

    public function getNode()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[node]');
    }

    public function getProtocol()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[protocol]');
    }

    public function getIpAddress()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[ip_address]');
    }

    public function getPort()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[port]');
    }

    public static function getValidProtocols()
    {
        return [self::PROTOCOL_AMQP, self::PROTOCOL_AMQP_SSL, self::PROTOCOL_CLUSTERING];
    }
}
