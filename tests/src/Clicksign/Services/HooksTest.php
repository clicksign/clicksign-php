<?php

namespace Clicksign\Services\Test;

use CLicksign\Client;
use Clicksign\Services\Hooks;


class HooksTest extends \PHPUnit_Framework_TestCase
{
    function setUp()
    {
        $this->clientMock = $this->getMockBuilder('Clicksign\Client')
        ->setMethods(array('request'))
        ->getMock();
    }

    /**
     * Test all()
     * @covers Client::Services::Hooks::all
     * @test
     */
    public function testAll()
    {
        $key = "084b90fe-dd12-47cf-92a7-4aa0e2d28bfa";
        $data = array();

        $this->clientMock->expects($this->once())
            ->method('request')
            ->with("/documents/$key/hooks", "GET", $data, 200);

        $hooks = new Hooks($this->clientMock);
        $hooks->all($key);
    }

    /**
     * Test create($keys)
     * @covers Client::Services::Hooks::create($documentKeys)
     * @test
     */
    public function testCreate()
    {
        $key = "65297ef1-2b9f-4f84-9a4f-f8062335c51a";
        $url = "http://example.com/callback/url";

        $json = json_encode(array("url" => $url));

        $this->clientMock->expects($this->once())
            ->method('request')
            ->with("/documents/$key/hooks", "POST", $json, 200, "application/json");

        $hooks = new Hooks($this->clientMock);
        $hooks->create($key, $url);
    }

    /**
     * Test delete($key)
     * @covers Client::Services::Hooks::delete($batchKey)
     * @test
     */
    public function testCancel()
    {
        $key = "65297ef1-2b9f-4f84-9a4f-f8062335c51a";
        $hookKey = "c02e78cc-f4da-424a-97eb-3694d50a3514";
        $data = array();

        $this->clientMock->expects($this->once())
            ->method('request')
            ->with("/documents/$key/hooks/$hookKey", "DELETE", $data, 204);;

        $hooks = new Hooks($this->clientMock);
        $hooks->delete($key, $hookKey);
    }
}
