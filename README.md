PHP Trello API v1 client
========================

[![Build Status](https://img.shields.io/travis/cdaguerre/php-trello-api.svg?branch=master&style=flat-square)](https://travis-ci.org/cdaguerre/php-trello-api) 
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/cdaguerre/php-trello-api/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/cdaguerre/php-trello-api/?branch=master)
[![Code Quality](https://img.shields.io/scrutinizer/g/cdaguerre/php-trello-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/cdaguerre/php-trello-api/)
[![Packagist](https://img.shields.io/packagist/dt/cdaguerre/php-trello-api.svg?style=flat-square)](https://packagist.org/packages/cdaguerre/php-trello-api)

A simple Object Oriented wrapper for the Trello API, written in PHP5.

Uses [Trello API v1](https://trello.com/docs/index.html). The object API is very similar to the RESTful API.

## Features

* Follows PSR-0 conventions and coding standards: autoload friendly
* Light and fast thanks to lazy loading of API classes
* Extensively tested

## Requirements

* PHP >= 5.3.2 with [cURL](http://php.net/manual/en/book.curl.php) extension,
* [Guzzle](https://github.com/guzzle/guzzle) library,
* (optional) [PHPUnit](https://phpunit.de) to run tests.

## Installation

The recommended way is using [composer](http://getcomposer.org):

```bash
$ composer require cdaguerre/php-trello-api:@dev
```
However, `php-trello-api` follows the PSR-0 naming conventions, which means you can easily integrate `php-trello-api` class loading in your own autoloader.

## Basic usage

```php
use Trello\Client;

$client = new Client();
$client->authenticate('api_key', 'token', Client::AUTH_URL_CLIENT_ID);

$boards = $client->api('member')->boards()->all();
```

The `$client` object gives you access to the entire Trello API.

## Advanced usage with the Trello manager

This package includes a simple model layer above the API with a nice chainable API allowing following manipulation of Trello objects:

```php
use Trello\Client;
use Trello\Manager;

$client = new Client();
$client->authenticate('api_key', 'token', Client::AUTH_URL_CLIENT_ID);

$manager = new Manager($client);

$card = $manager->getCard('547440ad3f8b882bc11f0497');

$card
    ->setName('Test card')
    ->setDescription('Test description')
    ->save();
```

## Dispatching Trello events to your app

The service uses the [Symfony EventDispatcher](https://github.com/symfony/EventDispatcher) component to dispatch events occuring on incoming webhooks.

Take a look at the [Events](https://github.com/cdaguerre/php-trello-api/blob/master/lib/Trello/Events.php) class constants for names and associated event classes.

```php
use Trello\Client;
use Trello\Service;
use Trello\Events;

$client = new Client();
$client->authenticate('api_key', 'token', Client::AUTH_URL_CLIENT_ID);

$service = new Service($client);

// Bind a callable to a given event...
$service->addListener(Events::BOARD_UPDATE, function ($event) {
    $board = $event->getBoard();

    // do something
});

// Check if the current request was made by a Trello webhook
// This will dispatch any Trello event to listeners defined above
$service->handleWebhook();
```

## Documentation
* Package [API](docs/Api/Index.md)
* Official [API documentation](https://trello.com/docs/index.html).

## Contributing

Feel free to make any comments, file issues or make pull requests.

## License

`php-trello-api` is licensed under the MIT License - see the LICENSE file for details

## Credits

- Largely inspired by the excellent [php-github-api](https://github.com/KnpLabs/php-github-api) developed by the guys at [KnpLabs](http://knplabs.fr)
- Thanks to Trello for the API and documentation.
