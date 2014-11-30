<?php
require_once(__DIR__ . '/../ClicksignClient.php');
require_once(__DIR__ . '/../ClicksignService.php');
    
class ClicksignHooks extends ClicksignService
{
    public function all($documentKey)
    {
        $data = array();
        return $this->client->request("/documents/$documentKey/hooks", "GET", $data, 200, "ClicksignHook");
    }

    public function create($documentKey, $url)
    {
        $data = array("url" => $url);
        $json = json_encode($data);
        return $this->client->request("/documents/$documentKey/hooks", "POST", $json, 200, "ClicksignHook", "application/json");
    }

    public function delete($documentKey, $hookKey)
    {
        $data = array();
        return $this->client->request("/documents/$documentKey/hooks/$hookKey", "DELETE", $data, 200, "ClicksignHook");
    }    
}
