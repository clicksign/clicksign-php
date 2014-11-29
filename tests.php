<?php

require_once(__DIR__ . "/lib/ClicksignClient.php");

$client = new ClicksignClient();

$client->setUrl("https://api.clicksign-demo.com/");
$client->setAccessToken("d85baa81c0f1f8a11cafda86ac30f535");

$client->documents->upload("/Users/vitorfs/Sites/clicksign-php/UploadTest.pdf");