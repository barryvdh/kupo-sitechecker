<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class UrlFetcher
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client = null)
    {
        $this->setClient($client ?: new Client());
    }

    /**
     * Fetch an URL.
     *
     * @param $url string
     *
     * @throws \RuntimeException
     *
     * @return ResponseInterface
     */
    public function fetch($url)
    {
        return $this->client->request('GET', $url);
    }

    /**
     * Set the HTTP Client.
     *
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }
}
