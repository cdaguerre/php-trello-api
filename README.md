PHP Trello API v1 client
========================

A simple Object Oriented wrapper for the Trello API, written in PHP5 and tested/working on **PHP7 and 8**.

Uses [Trello API](https://developer.atlassian.com/cloud/trello/guides/rest-api/api-introduction/). 
The object API is very similar to the RESTful API.

## Features

* Follows PSR-0 conventions and coding standards: autoload friendly
* Follows PSR-7 conventions and coding standards
* Light and fast thanks to lazy loading of API classes
* Extensively tested (it's not working!)
* Works on PHP 7 and 8

## Requirements

* PHP >= 7.4 with [cURL](http://php.net/manual/en/book.curl.php) extension,
* [Guzzle 7](https://github.com/guzzle/guzzle) library,
* (optional) [PHPUnit](https://phpunit.de) to run tests.

## Installation

The recommended way is using [composer](http://getcomposer.org):

```bash
$ composer require ectechnologiesbr/php-trello-api:@dev
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

```php
//TODO Its changes and needs to be documented.
```

## Documentation
* Package [API](docs/Api/Index.md)
* Official [API documentation](https://developer.atlassian.com/cloud/trello/guides/rest-api/api-introduction/).

## Contributing

Feel free to make any comments, file issues or make pull requests.

## License

`php-trello-api` is licensed under the MIT License - see the LICENSE file for details

## Credits

- All credits for this amazing package go to [@cdaguerre](https://github.com/cdaguerre/php-trello-api).
I just merged a few commits from other forks and made it work these days.