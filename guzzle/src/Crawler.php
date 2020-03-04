<?php

namespace Crawler;

use Crawler\Operation\OperationInterface;

class Crawler
{
    /**
     * @var \Psr\Http\Client\ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $body = false;

    /**
     * @param \Psr\Http\Client\ClientInterface $client
     */
    public function __construct(\GuzzleHttp\ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $url
     */
    public function load(string $url)
    {
        $res = $this->client->request('GET', $url);
        $statusCode = $res->getStatusCode();

        if ($statusCode < 200 || $statusCode >= 300) {
            throw new \RuntimeException('Request returned code '.$statusCode.'.');
        }

        $this->body = $res->getBody();
    }

    /**
     * @param \Crawler\Operation\OperationInterface
     *
     * @return mixed
     */
    public function execOperation(OperationInterface $operation)
    {
        return $operation->getData($this->body);
    }
}
