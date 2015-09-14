<?php

namespace Clicksign\Test;

use Clicksign\Client;


class ClientTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->client = new Client();
        $this->client->setUrl("http://example.com/");
        $this->client->setAccessToken("my_token");
    }

    /**
     * Test loading with a good API connection.
     * @covers Client::setUrl($url)
     * @covers Client::setAccessToken($accessToken)
     * @test
     */
    public function testConfigure()
    {
        $reflection = new \ReflectionClass('Clicksign\Client');
        $url = $reflection->getProperty("url");
        $url->setAccessible(true);
        $accessToken = $reflection->getProperty("accessToken");
        $accessToken->setAccessible(true);

        $this->assertEquals('http://example.com/', $url->getValue($this->client));
        $this->assertEquals('my_token', $accessToken->getValue($this->client));
    }
}
