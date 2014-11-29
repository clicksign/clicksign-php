<?php

require_once(__DIR__ . "/lib/ClicksignClient.php");

$client = new ClicksignClient();

$client->setAccessToken("d85baa81c0f1f8a11cafda86ac30f535");

$client->documents->upload("C:\Users\Vitor\Projetos\git\clicksign-php\myfile.txt", "text/plain");