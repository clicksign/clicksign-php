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

    protected function doRequest($url, $method, $data, $contentType = null, $filePath = null)
    {

    }
}
