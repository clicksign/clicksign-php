<?php

require_once(__DIR__ . "/lib/ClicksignClient.php");

$client = new ClicksignClient();

$client->setUrl("https://api.clicksign-demo.com/");
$client->setAccessToken("d85baa81c0f1f8a11cafda86ac30f535");

//$client->documents->upload("/Users/vitorfs/Sites/clicksign-php/UploadTest.pdf");


$signers[0]["email"] = "vitor@freitas.com";
$signers[0]["act"] = "sign";

$signers[1]["email"] = "vitor_fs@hotmail.com";
$signers[1]["act"] = "witness";

//$client->documents->createList("5ddcd17c-1681-470b-9812-0ccfc6da38a7", $signers);


//$docs = $client->documents->all();
//var_dump($docs);

//$file = $client->documents->download("5ddcd17c-1681-470b-9812-0ccfc6da38a7");

?>