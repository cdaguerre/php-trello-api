Trello Board Labels API
======================

### Get labels related to a given board
```php
$api->boards()->labels()->all(string $id, array $params)
```

### Get a label related to a given board
```php
$api->boards()->labels()->show(string $id, string $color)
```

### Set a label&#039;s name on a given board and for a given color
```php
$api->boards()->labels()->setName(string $id, string $color, string $name)
```

