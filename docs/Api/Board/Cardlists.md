Trello Board Lists API
======================

### Get a given board&#039;s lists
```php
$api->boards()->lists()->all(string $id, array $params)
```

### Filter card lists related to a given board
```php
$api->boards()->lists()->filter(string $id, string|array $filter)
```

### Create a list on a given board
```php
$api->boards()->lists()->create($id, array $params)
```

