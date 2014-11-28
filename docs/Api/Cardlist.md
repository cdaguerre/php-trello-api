Trello List API
======================

### Find a list by id
```php
$api->cardlists()->show(string $id, array $params)
```

### Create a list
```php
$api->cardlists()->create(array $params)
```

### Update a list
```php
$api->cardlists()->update(string $id, array $params)
```

### Set a given list&#039;s board
```php
$api->cardlists()->setBoard(string $id, string $boardId)
```

### Get a given list&#039;s board
```php
$api->cardlists()->getBoard(string $id, array $params)
```

### Get the field of a board of a given list
```php
$api->cardlists()->getBoardField(string $id, array $field)
```

### Set a given list&#039;s name
```php
$api->cardlists()->setName(string $id, string $name)
```

### Set a given list&#039;s description
```php
$api->cardlists()->setSubscribed(string $id, boolean $subscribed)
```

### Set a given list&#039;s state
```php
$api->cardlists()->setClosed(string $id, boolean $closed)
```

### Set a given list&#039;s position
```php
$api->cardlists()->setPosition(string $id, string|integer $position)
```

### Actions API
```php
$api->cardlists()->actions()
```

### Cards API
```php
$api->cardlists()->cards()
```

