<?php

namespace Hautelook\RabbitMQ;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Hautelook\RabbitMQ\Exception\RabbitMQApiException;
use Hautelook\RabbitMQ\Model\Overview;
use Hautelook\RabbitMQ\Model\Queue;

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

    /**
     * Gets a queue by queue name and vhost
     * @param string $vhost
     * @param string $queueName
     * @return Queue
     * @throws RabbitMQApiException
     */
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
