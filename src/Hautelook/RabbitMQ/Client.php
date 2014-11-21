<?php

namespace Hautelook\RabbitMQ;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Hautelook\RabbitMQ\Exception\RabbitMQApiException;
use Hautelook\RabbitMQ\Model\Overview;

class Client extends AbstractRabbitMQClient
{
    /**
     * Gets an overview of the RabbitMQ cluster
     *
     * @return Overview
     * @throws RabbitMQApiException
     */
    public function getOverview()
    {
        $command = $this->client->getCommand('GetOverview');
        try {
            $result = $command->execute();
        } catch (ClientErrorResponseException $e) {
            throw new RabbitMQApiException(
                $e->getResponse()->getReasonPhrase(),
                $e->getResponse()->getStatusCode()
            );
        }

        return $result;
    }

    public function getQueue($vhost, $queueName)
    {
        $command = $this->client->getCommand('GetQueue', ['vhost' => $vhost, 'queueName' => $queueName]);
        try {
            $result = $command->execute();
        } catch (ClientErrorResponseException $e) {
            throw new RabbitMQApiException(
                $e->getResponse()->getReasonPhrase(),
                $e->getResponse()->getStatusCode()
            );
        }

        return $result;
    }
} 
