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

    public function upload($filePath, $options = array())
    {
        if (isset($options["signers"]))
        {
            $d = $this->_upload($filePath);
            $documentKey = $d->document->key;
            $signers = $options["signers"];
            $message = $options["message"];
            $skipEmail = $options["skipEmail"];

            return $this->createList($documentKey, $signers, $message, $skipEmail);
        }
        else
        {
            return $this->_upload($filePath);
        }
    }

    public function cancel($documentKey)
    {
        $data = array();
        $json = json_encode($data);
        return $this->client->request("/documents/$documentKey/cancel", "POST", $json, 200, "application/json");
    }

    public function download($documentKey)
    {
        return $this->client->getFile("/documents/$documentKey/download");
    }

    public function createList($documentKey, $signers, $message = "", $skipEmail = false)
    {
        $data = array("signers" => $signers, "message" => $message, "skip_email" => $skipEmail);
        $json = json_encode($data);
        return $this->client->request("/documents/$documentKey/list", "POST", $json, 200, "application/json");
    }

    public function resend($documentKey, $email, $message)
    {
        $data = array("email" => $email, "message" => $message);
        $json = json_encode($data);
        return $this->client->request("/documents/$documentKey/resend", "POST", $json, 200, "application/json");
    }

    private function _upload($filePath)
    {
        $curl_file = $this->_getCurlFile($filePath);
        $file = array("document[archive][original]" => $curl_file);

        return $this->client->request("/documents", "POST", $file, 200, "multipart/mixed; boundary=frontier");
    }

    private function _getCurlFile($filename, $contentType='', $postname='')
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
