# Clicksign PHP Client

This is the PHP wrapper for [Clicksign REST API](http://clicksign.readme.io).

## Example of usage

Create a file named composer.json with the content below:

```javascript
{
    "require": {
        "clicksign/clicksign-php": "*"
    }
}
```

Then, create a file, for example sample.php, to load and use the library:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

use Clicksign\Client;

date_default_timezone_set('America/Bahia');

$client = new Client();
$client->setAccessToken("ACCESS_TOKEN"); //must be a valid token (ask Clicksign support team for a a valid token)
$client->setUrl("https://api.clicksign-demo.com/");
$docs = $client->documents->all();
print_r($docs);
?>
```

Then run `php sample.php`

A more advanced sample can be found in [example/sample2.php](example/sample2.php)

## Documents Services

### List all documents:

```php
$docs = $client->documents->all();

foreach ($docs as $d)
{
    print $d->document->key;
}
```

### Upload a document:

Upload only the file:

```php
$client->documents->upload("/Users/clicksign/Documents/Filename.pdf");
```

It also accepts an ```$options``` array:
```php
$signers = array(array("email" => "jose.silva@example.com", "act" => "sign"), array("email" => "joao.souza@example.org", "act" => "witness"));
$message = "Please sign this document.";
$skipEmail = false;

$options = array("signers" => signers, "message" => $message, "skipEmail" => $skipEmail);

$client->documents->upload("/Users/clicksign/Documents/Filename.pdf", $options);
```

This call will upload the file and create the signature list along with the message. If ```$options``` array is passed, _signers_ array inside of it is mandatory.

### Retrieve a document:

```php
$doc = $client->documents->find("DOCUMENT_KEY");

print $doc->document->original_name;
```

### Download a document:

```php
$file = $client->documents->download("DOCUMENT_KEY");
```

### Create a signature list:

```php
$signers[0]["email"] = "jose.silva@example.com";
$signers[0]["act"] = "sign";

$signers[1]["email"] = "joao.souza@example.org";
$signers[1]["act"] = "witness";

$client->documents->createList("DOCUMENT_KEY", $signers);
```

Or:

```php
$signers = array(array("email" => "jose.silva@example.com", "act" => "sign"), array("email" => "joao.souza@example.org", "act" => "witness"));
$client->documents->createList("DOCUMENT_KEY", $signers);
```

You may pass `message` and `skip_email` parameters:

```php
$client->documents->createList("DOCUMENT_KEY", $signers, "Hi guys, please sign this document.", false);
```

### Resend a document:

```php
$email = "jose.silva@example.com";
$message = "This is a reminder. Please sign the document";
$client->documents->resend("DOCUMENT_KEY", $email, $message);
```

### Cancel document:

```php
$client->documents->cancel("DOCUMENT_KEY");
```

## Hooks Services

### Create a hook:

```php
$hook = $client->hooks->create("DOCUMENT_KEY", "http://example.com/clicksign/callback.php");
```

### List all document's hooks:

```php
$hooks = $client->hooks->all("DOCUMENT_KEY");
```

### Delete a hook:

```php
$client->hooks->delete("DOCUMENT_KEY", 2163);
```

## Batches Services

### Create a batch:

```php
$documentKeys = array("DOCUMENT_KEY_1", "DOCUMENT_KEY_2", "DOCUMENT_KEY_3");
$batch = $client->batches->create($documentKeys);
```

### List all batches:

```php
$batches = $client->batches->all();
```

### Delete a batch:

```php
$client->batches->delete("DOCUMENT_BATCH_KEY");
```
