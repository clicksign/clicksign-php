# Clicksign PHP Client

## Setup

You must provide a valid `token` in order to use the library.

The required `token` is provided by the Clicksign support team.

```
require_once(__DIR__ . "/lib/ClicksignClient.php");

$client = new ClicksignClient();
$client->setAccessToken("ACCESS_TOKEN");
```

## Documents Services

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

Or:

```
$signers = array(array("email" => "vitor@freitas.com", "act" => "sign"), array("email" => "vitor_fs@hotmail.com", "act" => "witness"));
$client->documents->createList("5ddcd17c-1681-470b-9812-0ccfc6da38a7", $signers);
```

You may pass `message` and `skip_email` parameters:

```
$client->documents->createList("5ddcd17c-1681-470b-9812-0ccfc6da38a7", $signers, "Hi guys, please sign this document.", false);
```

## Hooks Services

Create a hook:

```
$hook = $client->hooks->create("9b9ea50e-076a-4a65-ae3f-ab182bc84227", "http://vitorfs.com/teste/");
```

List all document's hooks:

```
$hooks = $client->hooks->all("9b9ea50e-076a-4a65-ae3f-ab182bc84227");
```

Delete a hook:

```
$client->hooks->delete("9b9ea50e-076a-4a65-ae3f-ab182bc84227", 2163);
```

## Batches Services

Create a batch:

```
$documentKeys = array("9b9ea50e-076a-4a65-ae3f-ab182bc84227", "5ddcd17c-1681-470b-9812-0ccfc6da38a7");
$batch = $client->batches->create($documentKeys);
```

List all batches:

```
$batches = $client->batches->all();
```

Delete a hook:

```
$client->batches->delete("d019c9c3-0a50-4489-85ea-29a918a29b3e");
```
