# Clicksign PHP Client

## Setup

You must provide a valid `token` in order to use the library.

The required `token` is provided by the Clicksign support team.

```php
require_once(__DIR__ . "/clicksign/ClicksignClient.php");

$client = new ClicksignClient();
$client->setAccessToken("ACCESS_TOKEN");
```

## Documents Services

List all documents:

```php
$docs = $client->documents->all();

foreach ($docs as $d)
{
    print $d->document->key;
}
```

Upload a document:

```php
$client->documents->upload("/Users/vitorfs/Documents/Filename.pdf");
```

Retrieve a document:

```php
$doc = $client->documents->find("DOCUMENT_KEY");

print $doc->document->original_name;
```

Download a document:

```php
$file = $client->documents->download("DOCUMENT_KEY");
```

Create a signature list:

```php
$signers[0]["email"] = "vitor@freitas.com";
$signers[0]["act"] = "sign";

$signers[1]["email"] = "vitor_fs@hotmail.com";
$signers[1]["act"] = "witness";

$client->documents->createList("DOCUMENT_KEY", $signers);
```

Or:

```php
$signers = array(array("email" => "vitor@freitas.com", "act" => "sign"), array("email" => "vitor_fs@hotmail.com", "act" => "witness"));
$client->documents->createList("DOCUMENT_KEY", $signers);
```

You may pass `message` and `skip_email` parameters:

```php
$client->documents->createList("DOCUMENT_KEY", $signers, "Hi guys, please sign this document.", false);
```

## Hooks Services

Create a hook:

```php
$hook = $client->hooks->create("DOCUMENT_KEY", "http://vitorfs.com/teste/doSomething.php");
```

List all document's hooks:

```php
$hooks = $client->hooks->all("DOCUMENT_KEY");
```

Delete a hook:

```php
$client->hooks->delete("DOCUMENT_KEY", 2163);
```

## Batches Services

Create a batch:

```php
$documentKeys = array("DOCUMENT_KEY_1", "DOCUMENT_KEY_2", "DOCUMENT_KEY_3");
$batch = $client->batches->create($documentKeys);
```

List all batches:

```php
$batches = $client->batches->all();
```

Delete a batch:

```php
$client->batches->delete("DOCUMENT_BATCH_KEY");
```
