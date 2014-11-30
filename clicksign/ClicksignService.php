<?php

require_once(__DIR__ . '/ClicksignClient.php');

class ClicksignService
{
    protected $client;
    
    public function __construct(ClicksignClient $client)
    {
        $this->client = $client;
    }
}
