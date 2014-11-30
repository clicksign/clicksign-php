# Clicksign PHP Client

## Usage

### Setting up the client

You must provide a valid `token` in order to use the library.

The required `token` is provided by the Clicksign support team.

```
require_once(__DIR__ . "/lib/ClicksignClient.php");

$client = new ClicksignClient();
$client->setAccessToken("d85baa81c0f1f8a11cafda86ac30f535");
```