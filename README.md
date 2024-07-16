# PayU MEA PHP SDK

__Welcome to PayU PHP SDK__. This repository contains PayU's PHP SDK and samples for both Enterprise and Redirect SOAP API.

## Please Note
> **The Payment Card Industry (PCI) Council has [mandated](http://blog.pcisecuritystandards.org/migrating-from-ssl-and-early-tls) that early versions of TLS be retired from service.  All organizations that handle credit card information are required to comply with this standard. As part of this obligation, PayU has updated its services to require TLS 1.2 for all HTTPS connections. At this time, PayU will also require HTTP/1.1 for all connections.**

You can sign up for a PayU account at https://payu.co.za.

## Requirements

v1.* PHP 5.4 - PHP 7.4

v2.* PHP8 and above

## Composer

You can install the bindings via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require payumea/payu-sdk-php
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Dependencies

The bindings require the following extension in order to work properly:

- [`soap`](https://php.net/manual/en/book.soap.php)
- [`openssl`](http://php.net/manual/en/book.openssl.php)
- [`json`](https://php.net/manual/en/book.json.php)
- [`mbstring`](http://php.net/manual/en/book.mbstring.php)

If you use Composer, these dependencies should be handled automatically. If you install manually, you'll want to make sure that these extensions are available.

## Documentation

Please see the ``sample/doc`` directory for information on how to use this library
and the ``samples`` directory for examples on using this library. You should
be able to run all the examples by running ``php samples/index.php``.

## SDK Documentation

Everything from SDK Wiki, to Sample Codes, to Releases. Here are few quick links to get you there faster.

Please see  for up-to-date documentation.
* [ Samples ](samples)
* [ PayU Developer Docs] (http://help.payu.co.za/display/developers/)

## Development

Install dependencies:

``` bash
composer install
```

## Tests

Install dependencies as mentioned above (which will resolve [PHPUnit](http://packagist.org/packages/phpunit/phpunit)), then you can run the test suite:

```bash
./vendor/bin/phpunit
```

Or to run an individual test file:

```bash
./vendor/bin/phpunit tests/PayU/Test/Api/AmounTest.php
```
