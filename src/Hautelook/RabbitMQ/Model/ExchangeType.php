<?php

namespace Hautelook\RabbitMQ\Model;

class ExchangeType extends AbstractRabbitMQModel
{
    const TYPE_DIRECT = 'direct';
    const TYPE_FANOUT = 'fanout';
    const TYPE_HEADERS = 'headers';
    const TYPE_TOPIC = 'topic';

    public function getName()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[name]');
    }

    public function getDescription()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[description]');
    }

    public function isEnabled()
    {
        return $this->getPropertyAccessor()->getValue($this->data, '[enabled]');
    }

    public static function getValidExchangeNames()
    {
        return [self::TYPE_TOPIC, self::TYPE_FANOUT, self::TYPE_DIRECT, self::TYPE_HEADERS];
    }
}
