<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Clicksign\Client;

date_default_timezone_set('America/Bahia');

function setup() {
  $client = new Client();
  $client->setAccessToken("my_token");
  $client->setUrl("https://api.clicksign-demo.com/");

  $client->setAccessToken("xababa");
  $client->setUrl("http://localhost:3000/api/");
  return $client;
}

/**
 * List all documents
 */
function all() {
  global $client;
  $docs = $client->documents->all();
  foreach ($docs as $d) {
    print "{$d->document->key} - {$d->document->status} - {$d->document->original_name}\n";
  }
}

/**
 * Find a document by key and print it
 */
function find($key) {
  global $client;
  $d = $client->documents->find($key);
  print "{$d->document->key} - {$d->document->status} - {$d->document->original_name}\n";
}

/**
 * Helper function
 */
function new_file() {
  $name = "./" . strftime("%Y-%m-%d-%H-%M-%S") . ".txt";
  $string = "This is a very important document\n";
  file_put_contents($name, $string);
  return $name;
}

/**
 * Upload a document
 */
function create() {
  global $client;

  $d = $client->documents->upload(new_file());
  return $d->document->key;
}

/**
 * Create a signature list for a uploaded document
 */
function create_signature_list($key) {
  global $client;
  $signers = array(
    array("email" => "john.fowler@example.com", "act" => 'sign'),
    array("email" => "jane.smitha@example.com", "act" => 'sign'),
    array("email" => "alice.knuth@example.com", "act" => 'witness')
  );

  $result = $client->documents->createList($key, $signers, "Sign the document", false);
  return $key;
}

/**
 * Upload a document and create signature list
 */
function create_with_list() {
  global $client;
  $name = new_file();
  $signers = array(
    array("email" => "john.fowler@example.com", "act" => 'sign'),
    array("email" => "jane.smitha@example.com", "act" => 'sign'),
    array("email" => "alice.knuth@example.com", "act" => 'witness')
  );
  $options = array("signers" => $signers, "message" => "Please sign this documentationssasss", "skipEmail" => false);

  $result = $client->documents->upload($name, $options);
  return $result->document->key;
}

/**
 * Resend a document
 */
function resend($key)
{
  global $client;
  $email = "mauricio.vieira+junb@clicksign.com";
  $message = "Rapotchus";

  return $client->documents->resend($key,$email,$message);
}

/**
 * Cancel a document
 */
function cancel($key)
{
  global $client;
  return $client->documents->cancel($key);
}


/**
 * Download a document
 * Code send by: José Alexandre Monteiro - Webclasses
 */

$file = $client->documents->download($_GET['key']);

$file_array = explode("\n\r", $file, 2);
$header_array = explode("\n", $file_array[0]);
foreach($header_array as $header_value) {
    $header_pieces = explode(':', $header_value);
    if(count($header_pieces) == 2) {
        $headers[$header_pieces[0]] = trim($header_pieces[1]);
    }
}
header('Content-type: ' . $headers['Content-Type']);
header('Content-Disposition: ' . $headers['Content-Disposition']);
echo substr($file_array[1], 1);


$client = setup();
all();

$key = "sample_uuid";
find($key);

try {
  cancel($key);
} catch (Clicksign\ClicksignException $e) {
  var_dump($e);
}

find($key);
