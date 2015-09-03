<?php
require_once(__DIR__ . '/../ClicksignClient.php');
require_once(__DIR__ . '/../ClicksignService.php');

class ClicksignDocuments extends ClicksignService
{
    public function all()
    {
        $data = array();
        return $this->client->request("/documents", "GET", $data, 200, "application/json");
    }

    public function find($documentKey)
    {
        $data = array();
        return $this->client->request("/documents/$documentKey", "GET", $data, 200, "application/json");
    }

    public function upload($filePath, $params = array())
    {
        $curl_file = $this->getCurlFile($filePath);
        $file = array("document[archive][original]" => $curl_file);
        if (isset($params["signers"]))
        {
            $signers = array("signers[]" => $params["signers"]);
            unset($params[$signers]);
            array_merge($params, $signers);
        }

        if (isset($params["skip_email"]))
        {
            $params["skip_email"]= json_encode($params["skip_email"]);
        }

        $data = array_merge($params,$file);
        print "Debug upload\n";
        var_dump($data);
        print "\n\n";

        return $this->client->request("/documents", "POST", $data, 200, "multipart/form-data; boundary=frontier");
    }

    public function download($documentKey)
    {
        return $this->client->getFile("/documents/$documentKey/download");
    }

    public function createList($documentKey, $signers, $message = "", $skipEmail = false)
    {
        $data = array("signers" => $signers, "message" => $message, "skip_email" => $skipEmail);
        $json = json_encode($data);
        print "Debug createList\n";
        var_dump($json);
        return $this->client->request("/documents/$documentKey/list", "POST", $json, 200, "application/json");
    }

    private function getCurlFile($filename, $contentType='', $postname='')
    {
        // PHP 5.5 introduced a CurlFile object that deprecates the old @filename syntax
        // See: https://wiki.php.net/rfc/curl-file-upload
        if (function_exists('curl_file_create'))
        {
            return curl_file_create($filename, $contentType, $postname);
        }

        // Use the old style if using an older version of PHP
        $postname = $postname or $filename;
        $value = "@{$filename};filename=" . $postname;
        if ($contentType)
        {
            $value .= ';type=' . $contentType;
        }

        return $value;
    }
}
