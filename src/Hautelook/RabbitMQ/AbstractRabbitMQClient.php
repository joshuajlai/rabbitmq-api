<?php

namespace Hautelook\RabbitMQ;

use Guzzle\Service\Client as GuzzleClient;
use Guzzle\Service\Description\ServiceDescription;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

abstract class AbstractRabbitMQClient
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * @var array
     */
    private $options;

    /**
     * @var array
     */
    private $guzzleOptions;

    /**
     * @param array $options
     * @param array $additionalRequestOptions
     */
    public function __construct(array $options = [], array $additionalRequestOptions = [])
    {
        $this->resolveOptions($options);
        $this->resolveGuzzleOptions($additionalRequestOptions);

        $this->setupClient();
    }

    /**
     * @param EventSubscriberInterface $plugin
     */
    public function addGuzzlePlugin(EventSubscriberInterface $plugin)
    {
        $this->client->addSubscriber($plugin);
    }

    protected function configureOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'scheme' => 'https',
                'port' => 8080,
                'hostname' => 'localhost',
                'username' => 'guest',
                'password' => 'guest',
                'ssl' => true,
            ]
        );
        $resolver->setAllowedTypes(
            [
                'scheme' => 'string',
                'port' => 'integer',
                'hostname' => 'string',
                'username' => 'string',
                'password' => 'string',
                'ssl' => 'bool',
            ]
        );
        $resolver->setAllowedValues(
            [
                'scheme' => ['http', 'https'],
            ]
        );
    }

    /**
     * @param array $additionalRequestOptions
     */
    protected function resolveGuzzleOptions(array $additionalRequestOptions)
    {
        $this->guzzleOptions = array_merge(
            $additionalRequestOptions,
            [
                'ssl.certificate_authority' => $this->options['ssl'],
                'request.options' => [
                    'auth' => [
                        $this->options['username'],
                        $this->options['password'],
                    ],
                ],
            ]
        );
    }

    /**
     * @param array $options
     */
    protected function resolveOptions(array $options)
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);
        $this->options = $resolver->resolve($options);
    }

    protected function setupClient()
    {
        $this->client = new GuzzleClient($this->getBaseUrl(), $this->guzzleOptions);
        $this->client->setDescription(ServiceDescription::factory(__DIR__ . '/config/service.json'));
    }

    protected function getBaseUrl()
    {
        return sprintf(
            '%s://%s:%d',
            $this->options['scheme'],
            $this->options['hostname'],
            $this->options['port']
        );
    }
}
