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
