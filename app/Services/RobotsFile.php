<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use RobotsTxtParser;

class RobotsFile
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $url;

    /**
     * Content of the robots.txt file.
     *
     * @var string
     */
    private $content;

    /**
     * @var RobotsTxtParser
     */
    private $parser;

    public function __construct(ClientInterface $client = null)
    {
        $this->setClient($client ?: new Client());
    }

    /**
     * Get the content of the robots.txt file.
     */
    public function getContent()
    {
        if ($this->content === null) {
            try {
                $this->content = (string) $this->client->get($this->url)->getBody();
            } catch (ClientException $e) {
                $this->content = '';
            }
        }

        return $this->content;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $url
     *
     * @return RobotsFile
     */
    public function setUrl($url)
    {
        $url = (string) $url;

        if ($url !== $this->url) {
            $this->content = null;
        }

        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return RobotsTxtParser
     */
    public function getParser()
    {
        if (!$this->parser) {
            $this->setParser(new RobotsTxtParser($this->getContent()));
        }

        return $this->parser;
    }

    /**
     * @param RobotsTxtParser $parser
     */
    public function setParser(RobotsTxtParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}
