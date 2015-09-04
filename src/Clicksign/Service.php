<?php

namespace Clicksign;

class Service
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
