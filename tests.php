<?php

require_once(__DIR__ . "/lib/ClicksignClient.php");

$client = new ClicksignClient();

$client->setAccessToken("");

$client->documents->getAllDocumments();