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

$signers = array(array("email" => "vitor@freitas.com", "act" => "sign"), array("email" => "vitor_fs@hotmail.com", "act" => "witness"));
$client->documents->createList("5ddcd17c-1681-470b-9812-0ccfc6da38a7", $signers);


//$docs = $client->documents->all();
//var_dump($docs);

//$file = $client->documents->download("5ddcd17c-1681-470b-9812-0ccfc6da38a7");

$batch = array("9b9ea50e-076a-4a65-ae3f-ab182bc84227", "5ddcd17c-1681-470b-9812-0ccfc6da38a7");
//$client->batches->create($batch);

//$client->batches->all();

//$client->batches->delete("d019c9c3-0a50-4489-85ea-29a918a29b3e");

//$client->hooks->create("9b9ea50e-076a-4a65-ae3f-ab182bc84227", "http://vitorfs.com/teste/");

//$client->hooks->all("9b9ea50e-076a-4a65-ae3f-ab182bc84227");

//$client->hooks->delete("9b9ea50e-076a-4a65-ae3f-ab182bc84227", 2163);

//2162, 2163