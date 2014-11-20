<?php

namespace Hautelook\RabbitMQ;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Service\Client as GuzzleClient;
use Guzzle\Service\Description\ServiceDescription;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Client 
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * @param string $baseUrl
     */
    public function __construct($baseUrl)
    {
        $this->client = new GuzzleClient(
            $baseUrl,
            [
                'ssl.certificate_authority' => false,
                'request.options' => [
                    'auth' => [
                        'rabbit',
                        'hare'
                    ]
                ]
            ]
        );
        $this->client->setDescription(ServiceDescription::factory(__DIR__ . '/config/service.json'));

    }

    /**
     * @param EventSubscriberInterface $plugin
     */
    public function addGuzzlePlugin(EventSubscriberInterface $plugin)
    {
        $this->client->addSubscriber($plugin);
    }

    /**
     * Gets an overview of the RabbitMQ cluster
     *
     */
    public function getOverview()
    {
        $command = $this->client->getCommand('GetOverview');
        try {
            $result = $command->execute();
        } catch (ClientErrorResponseException $e) {
//            throw new NotFoundException();
        }

        return $result;
    }
} 
