<?php

namespace Clicksign\Services\Test;

use CLicksign\Client;
use Clicksign\Services\Batches;


class BatchesTest extends \PHPUnit_Framework_TestCase
{
    function setUp()
    {
        $this->clientMock = $this->getMockBuilder('Clicksign\Client')
        ->setMethods(array('request'))
        ->getMock();
    }

    /**
     * Test all()
     * @covers Client::Services::Batches::all
     * @test
     */
    public function testAll()
    {
        $data = array();

        $this->clientMock->expects($this->once())
            ->method('request')
            ->with("/batches", "GET", $data, 200);

        $batches = new Batches($this->clientMock);
        $batches->all();
    }

    /**
     * Test create($keys)
     * @covers Client::Services::Batches::create($documentKeys)
     * @test
     */
    public function testCreate()
    {
        $keys = array("65297ef1-2b9f-4f84-9a4f-f8062335c51a",
            "6014b679-e5a0-47bc-803a-3bf880c90697",
            "b20da41b-7619-439a-961e-931de653a718");
        $json = json_encode(array("keys" => $keys));

        $this->clientMock->expects($this->once())
            ->method('request')
            ->with("/batches", "POST", $json, 200, "application/json");

        $batches = new Batches($this->clientMock);
        $batches->create($keys);
    }

    /**
     * Test delete($key)
     * @covers Client::Services::Batches::delete($batchKey)
     * @test
     */
    public function testCancel()
    {
        $key = "c02e78cc-f4da-424a-97eb-3694d50a3514";
        $data = array();

        $this->clientMock->expects($this->once())
            ->method('request')
            ->with("/batches/$key", "DELETE", $data, 204);

        $batches = new Batches($this->clientMock);
        $batches->delete($key);
    }
}
