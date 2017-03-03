<?php

namespace Tests\Rules;

use App\Facades\RobotsFile;
use App\Rules\RobotsAllowedInTxt;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\BrowserKitTestCase;

class RobotsAllowedInTxtTest extends BrowserKitTestCase
{
    public function testCheckEmpty()
    {
        list($crawler, $response, $uri) = $this->createArgumentsFromMessage('Empty');

        $mock = new MockHandler([
            $response
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        RobotsFile::setClient($client);

        $rule = new RobotsAllowedInTxt();

        static::assertTrue($rule->check($crawler, $response, $uri));
    }

    public function testCheckNoRobots()
    {
        list($crawler, $response, $uri) = $this->createArgumentsFromMessage('PlainResponse');

        $mock = new MockHandler([
            new Response(404),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        RobotsFile::setClient($client);

        $rule = new RobotsAllowedInTxt();
        static::assertTrue($rule->check($crawler, $response, $uri));
    }

    public function testFailsDisallow()
    {
        list($crawler, $response, $uri) = $this->createArgumentsFromMessage('RobotsDisallow');

        $mock = new MockHandler([
            $response
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        RobotsFile::setClient($client);

        $rule = new RobotsAllowedInTxt();
        static::assertFalse($rule->check($crawler, $response, $uri));
    }


}
