<?php

namespace Clicksign\Services;

use Clicksign\Client;
use Clicksign\Service;

class Hooks extends Service
{
    public function all($documentKey)
    {
        $data = array();
        return $this->client->request("/documents/$documentKey/hooks", "GET", $data, 200);
    }

    public function create($documentKey, $url)
    {
        $data = array("url" => $url);
        $json = json_encode($data);
        return $this->client->request("/documents/$documentKey/hooks", "POST", $json, 200, "application/json");
    }

    public function delete($documentKey, $hookKey)
    {
        $data = array();
        return $this->client->request("/documents/$documentKey/hooks/$hookKey", "DELETE", $data, 204);
    }
}
