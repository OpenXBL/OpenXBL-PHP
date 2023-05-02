# OpenXBL PHP Wrapper 
This PHP package is a lightweight wrapper for OpenXBL. It's the easiest way to use OpenXBL in your PHP application.

Part of the [XBL.IO](https://xbl.io) feature set.

```php
<?php
// Instantiate.
require __DIR__ . '/vendor/autoload.php';
use OpenXBL\Client;

$client = new Client('API_KEY');

print_r($client->get('account'));
?>
```

Quickstart
----------

This library is available through [Composer](https://getcomposer.org).

Use the following command:

    `composer require openxbl/openxbl`

Alternatively, add the repository in your **composer.json** file. If you don't already have this file create it at the root of your project with this content:

```json
{
    "name": "Example Application",
    "description": "This is an example of OpenXBL",
    "require": {
        "openxbl/openxbl": "^2"
    }
}
```

Making an App Request
----------

```php
<?php
// Instantiate.
require __DIR__ . '/vendor/autoload.php';
use OpenXBL\Client;

$client = new Client('APP_KEY');

$client->isApp = true;

print_r($client->get('account'));
?>
```

Optional Parameters
----------
```php
<?php
// Format the response (either json or xml).
$client->format = 'json';

// Language of response. 
$client->language = 'en-US,en';
?>
```

Supported APIs
----------
This wrapper is built using **OpenXBL /api/v2/**

Collaborate
----------
Visit our [discord channel](https://discord.gg/x6kk8M2) and say hello!
