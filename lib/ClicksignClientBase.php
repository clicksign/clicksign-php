<?php

abstract class ClicksignClientBase
{
    protected $url = "https://api.clicksign-demo.com/v1/";
    protected $accessToken = null;
    protected $timeout = 240;

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    protected function doRequest($url, $method, $data, $dataType = "json", $contentType = null, $filePath = null)
    {
        $c = curl_init();

        $header[] = "Accept: application/" . $dataType;
        $url .= $this->url . "?access_token=" . $this->accessToken;

        curl_setopt($c, CURLOPT_HTTPHEADER, $header);
        curl_setopt($c, CURLOPT_TIMEOUT, $this->timeout);

        switch($method)
        {
            case "FILE":
                curl_setopt($c, CURLOPT_HTTPHEADER, array("Content-type: $contentType"));
                curl_setopt($c, CURLOPT_POST, true);
                curl_setopt($c, CURLOPT_POSTFIELDS, file_get_contents($filePath));
                
                if(count($data))
                {
                    $url .= http_build_query($data);
                }
                break;
                
            case "GET":
                curl_setopt($c, CURLOPT_HTTPGET, true);
                if(count($data))
                {
                    $url .= http_build_query($data);
                }
                break;
                
            case "POST":
                curl_setopt($c, CURLOPT_POST, true);
                if(count($data))
                {
                    curl_setopt($c, CURLOPT_POSTFIELDS, $data);
                }
                break;
        }

        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);

        $response = curl_exec($c);

        curl_close($c);
    }

    public function request($url, $method, $data, $dataType, $expectedHttpCode, $returnType, $isArray = false)
    {
        $response = $this->doRequest($url, $method, $data, $dataType);
        return $this->parseResponse($url, $response, $returnType, $expectedHttpCode, $isArray);
    }

    public function parseResponse($url, $response, $dataType, $returnType, $expectedHttpCode, $isArray = false)
    {

    }

    public function upload($url, $data, $expectedHttpCode, $returnType, $contentType, $filePath)
    {

    }

}