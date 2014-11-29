<?php

abstract class ClicksignClientBase
{
    protected $url = "https://api.clicksign.com/";
    protected $accessToken = null;
    protected $timeout = 240;
    protected $version = "v1";

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    public function setVersion($version)
    {
        $this->version = $version;
    }

    protected function doRequest($url, $method, $data)
    {
        $c = curl_init();

        $header = array("Accept: application/json");

        $url = $this->url . $this->version . $url . "?access_token=" . $this->accessToken;

        switch($method)
        {
            case "FILE":
                array_push($header, "Content-type: multipart/mixed; boundary=frontier");
                curl_setopt($c, CURLOPT_POST, true);
                if(count($data))
                {
                    curl_setopt($c, CURLOPT_POST, count($data));
                    curl_setopt($c, CURLOPT_POSTFIELDS, $data);
                }
                break;
                
            case "GET":
                curl_setopt($c, CURLOPT_HTTPGET, true);
                if(count($data))
                {
                    $url .= "&" . http_build_query($data);
                }
                break;
                
            case "POST":
                curl_setopt($c, CURLOPT_POST, true);
                if(count($data))
                {
                    curl_setopt($c, CURLOPT_POST, count($data));
                    curl_setopt($c, CURLOPT_POSTFIELDS, $data);
                }
                break;
        }

        curl_setopt($c, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($c, CURLOPT_HTTPHEADER, $header);
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);

        $response = curl_exec($c);

        curl_close($c);
    }

    public function request($url, $method, $data, $expectedHttpCode, $returnType, $isArray = false)
    {
        $response = $this->doRequest($url, $method, $data);
        return $this->parseResponse($url, $response, $returnType, $expectedHttpCode, $isArray);
    }

    public function parseResponse($url, $response, $returnType, $expectedHttpCode, $isArray = false)
    {
        
    }

}
