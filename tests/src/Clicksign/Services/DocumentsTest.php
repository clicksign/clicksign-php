<?php

namespace Clicksign\Services\Test;

use CLicksign\Client;
use Clicksign\Services\Documents;


class DocumentsTest extends \PHPUnit_Framework_TestCase
{
    function setUp()
    {
        $this->clientMock = $this->getMockBuilder('Clicksign\Client')
        ->setMethods(array('request','getFile'))
        ->getMock();
    }

    /**
     * Test all()
     * @covers Client::Services::Documents::all
     * @test
     */
    public function testAll()
    {
        $data = array();

        $this->clientMock->expects($this->once())
            ->method('request')
            ->with("/documents", "GET", $data, 200, "application/json");

        $documents = new Documents($this->clientMock);
        $documents->all();
    }

    /**
     * Test find($key)
     * @covers Client::Services::Documents::find($documentKey)
     * @test
     */
    public function testFind()
    {
        $key = "65297ef1-2b9f-4f84-9a4f-f8062335c51a";
        $data = array();

        $this->clientMock->expects($this->once())
            ->method('request')
            ->with("/documents/$key", "GET", $data, 200, "application/json");

        $documents = new Documents($this->clientMock);
        $documents->find($key);
    }

    /**
     * Test cancel($key)
     * @covers Client::Services::Documents::cancel($documentKey)
     * @test
     */
    public function testCancel()
    {
        $key = "65297ef1-2b9f-4f84-9a4f-f8062335c51a";
        $json = json_encode(array());

        $this->clientMock->expects($this->once())
            ->method('request')
            ->with("/documents/$key/cancel", "POST", $json, 200, "application/json");

        $documents = new Documents($this->clientMock);
        $documents->cancel($key);
    }

    /**
     * Test download($key)
     * @covers Client::Services::Documents::download($documentKey)
     * @test
     */
    public function testDownload()
    {
        $key = "65297ef1-2b9f-4f84-9a4f-f8062335c51a";

        $this->clientMock->expects($this->once())
            ->method('getFile')
            ->with("/documents/$key/download");

        $documents = new Documents($this->clientMock);
        $documents->download($key);
    }

    /**
     * Test createList($key)
     * @covers Client::Services::Documents::createList($documentKey)
     * @test
     */
    public function testCreateList()
    {
        $key = "65297ef1-2b9f-4f84-9a4f-f8062335c51a";
        $signers = array(
            array("email" => "john.doe@example.com", "act" => 'sign'),
            array("email" => "jane.barbera@example.com", "act" => 'sign'),
            array("email" => "mat.smith@example.com", "act" => 'witness')
        );

        $message = "A new document is waiting for you";
        $skipEmail = false;
        $data = array("signers" => $signers, "message" => $message, "skip_email" => $skipEmail);
        $json = json_encode($data);

        $this->clientMock->expects($this->once())
            ->method('request')
            ->with("/documents/$key/list", "POST", $json, 200, "application/json");

        $documents = new Documents($this->clientMock);
        $documents->createList($key, $signers, $message, $skipEmail);
    }

    /**
     * Test resend($key)
     * @covers Client::Services::Documents::resend($documentKey)
     * @test
     */
    public function testResend()
    {
        $email = 'john.doe@example.com';
        $message = 'A new document is waiting for you';

        $key = "65297ef1-2b9f-4f84-9a4f-f8062335c51a";
        $json = json_encode(array("email" => $email, "message" => $message));

        $this->clientMock->expects($this->once())
            ->method('request')
            ->with("/documents/$key/resend", "POST", $json, 200, "application/json");

        $documents = new Documents($this->clientMock);
        $documents->resend($key, $email, $message);
    }
}
