<?php
require_once(__DIR__ . '/vendor/autoload.php');

use Clicksign\Client;

date_default_timezone_set('America/Bahia');

$client = new Client();
$client->setAccessToken("ACCESS_TOKEN"); //must be a valid token (Ask Clicksign support team for a a valid token)
$client->setUrl("https://api.clicksign-demo.com/");
$docs = $client->documents->all();
print_r($docs);
?>