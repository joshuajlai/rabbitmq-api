<?php

namespace Hautelook\RabbitMQ\Model;

use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Command\ResponseClassInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

abstract class AbstractRabbitMQModel implements ResponseClassInterface
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var PropertyAccess
     */
    private $propertyAccessor;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public static function fromCommand(OperationCommand $command)
    {
        $response = json_decode($command->getResponse()->getBody(true), true);

        $class = get_called_class(); // Cannot do new self() with abstract class

        return new $class($response);
    }

    /**
     * @return \Symfony\Component\PropertyAccess\PropertyAccessor
     */
    protected function getPropertyAccessor()
    {
        if (!$this->propertyAccessor) {
            $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
        }

        return $this->propertyAccessor;
    }

    /**
     * @return array
     */
    protected function getData()
    {
        return $this->data;
    }

} 
