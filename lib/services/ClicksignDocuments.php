<?php
require_once(__DIR__ . '/../ClicksignClient.php');
require_once(__DIR__ . '/../ClicksignService.php');
require_once(__DIR__ . '/../models/ClicksignDocument.php');
    
class ClicksignDocuments extends ClicksignService
{

    public function getAllDocumments()
    {
        return $this->client->request("/documents", "GET", array(), 200, "ClicksignDocument");
    }

    public function getDocumment($documentKey)
    {
        return $this->client->request("/documents/$documentKey", "GET", array(), 200, "ClicksignDocument");
    }
    
}
