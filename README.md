# Clicksign PHP Client

## Usage

### Setting up the client

You must provide a valid `token` in order to use the library.

The required `token` is provided by the Clicksign support team.

```
require_once(__DIR__ . "/lib/ClicksignClient.php");

$client = new ClicksignClient();
$client->setAccessToken("ACCESS_TOKEN");
```

### Documents Services

List all documents:

```
$docs = $client->documents->all();
```

Upload a document:

```
$client->documents->upload("/Users/vitorfs/Documents/Filename.pdf");
```

Retrieve a document:

```
$doc = $client->documents->find("DOCUMENT_KEY");
```

Download a document:

```
$file = $client->documents->download("DOCUMENT_KEY");
```

Create a signature list:

```
$signers[0]["email"] = "vitor@freitas.com";
$signers[0]["act"] = "sign";

$signers[1]["email"] = "vitor_fs@hotmail.com";
$signers[1]["act"] = "witness";

$client->documents->createList("5ddcd17c-1681-470b-9812-0ccfc6da38a7", $signers);
```

Or

```
$signers = array(array("email" => "vitor@freitas.com", "act" => "sign"), array("email" => "vitor_fs@hotmail.com", "act" => "witness"));
$client->documents->createList("5ddcd17c-1681-470b-9812-0ccfc6da38a7", $signers);
```
