# OpenXBL PHP Wrapper 
This PHP package is a lightweight wrapper for OpenXBL. That's the easiest way to use OpenXBL in your PHP applications.

[![Build Status](https://travis-ci.org/OpenXBL/OpenXBL-PHP.svg)](https://travis-ci.org/OpenXBL/OpenXBL-PHP)

Part of the [XBL.IO](https://xbl.io) feature set.

```php
<?php
/**
 * # Instantiate.
 */
require __DIR__ . '/vendor/autoload.php';
use \OpenXBL\Api;

$xbox = new Api('API_KEY');

print $xbox->get('/account');
?>
```

Quickstart
----------

To download this wrapper and integrate it inside your PHP application, you can use [Composer](https://getcomposer.org).

Quick integration with the following command:

    composer require openxbl/openxbl

Or add the repository in your **composer.json** file or if you don't already have
this file create it at the root of your project with this content:

```json
{
    "name": "Example Application",
    "description": "This is an example of OpenXBL",
    "require": {
        "openxbl/openxbl": "dev-master"
    }
}
```

Then, you can install the OpenXBL wrapper and dependencies with:

    php composer.phar install

This will install ``openxbl/openxbl`` to ``./vendor`` along with other dependencies
including ``autoload.php``.

Making an App Request
----------
```php
<?php
/**
 * # Instantiate.
 */
require __DIR__ . '/vendor/autoload.php';
use \OpenXBL\Api;

$xbox = new Api('APP_KEY');

$xbox->isApp = TRUE;

print $xbox->get('/account');

print $xbox->post('/clubs/reserve', array('name' => 'OpenXBL'));
?>
```

Optional Parameters
----------
```php
<?php
/**
 * # Format of the response.
 */
$xbox->format = 'json';

/**
 * # Language of response, if available. 
 */
$xbox->language = 'en-US, en';

?>
```

Supported APIs
----------
This wrapper is built using **OpenXBL /api/v2/**

Collaborate
----------
Visit our [discord channel](https://discord.gg/x6kk8M2) and say hello!.

Support
----------
The following support channels can be used for contact.

- [Twitter](https://twitter.com/OpenXBL)
- [Email](mailto:help@xbl.io)