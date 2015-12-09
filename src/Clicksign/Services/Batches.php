<?php

namespace Clicksign\Services;

use Clicksign\Client;
use Clicksign\Service;

class Batches extends Service
{
    public function all()
    {
        $data = array();
        return $this->client->request("/batches", "GET", $data, 200);
    }

    public function create($keys)
    {
        $data = array("keys" => $keys);
        $json = json_encode($data);
        return $this->client->request("/batches", "POST", $json, 200, "application/json");
    }

    public function delete($batchKey)
    {
        $data = array();
        return $this->client->request("/batches/$batchKey", "DELETE", $data, 204);
    }
}
