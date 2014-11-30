<?php
require_once(__DIR__ . '/../ClicksignClient.php');
require_once(__DIR__ . '/../ClicksignService.php');
    
class ClicksignBatches extends ClicksignService
{
    public function all()
    {
        $data = array();
        return $this->client->request("/batches", "GET", $data, 200, "ClicksignBatch");
    }

    public function create($keys)
    {
        $data = array("keys" => $keys);
        $json = json_encode($data);
        return $this->client->request("/batches", "POST", $json, 200, "ClicksignBatch", "application/json");
    }

    public function delete($batchKey)
    {
        $data = array();
        return $this->client->request("/batches/$batchKey", "DELETE", $data, 200, "ClicksignBatch");
    }
}
