<?php

namespace Tests\Unit;

use App\Services\UrlFetcher;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class UrlFetcherTest extends TestCase
{
    public function testFetch(): void
    {
        $mock = new MockHandler([
            new Response(200, [], '<html><body>Normal</body></html>'),
        ]);

        $client = new Client(['handler' => HandlerStack::create($mock)]);
        $fetcher = new UrlFetcher($client);

        $this->assertEquals('<html><body>Normal</body></html>', (string) $fetcher->fetch('http://foo.bar')->getBody());
    }
}
