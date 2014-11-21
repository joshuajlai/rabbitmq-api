<?php

namespace Hautelook\RabbitMQ\Model;

use Symfony\Component\PropertyAccess\PropertyAccessor;

trait AbstractRabbitMQTrait
{
    /**
     * @return PropertyAccessor
     */
    abstract protected function getPropertyAccessor();

    /**
     * @return array
     */
    abstract protected function getData();
} 
