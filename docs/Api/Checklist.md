Trello Checkist API
======================

### Find a list by id
```php
$api->checklists()->show(string $id, array $params)
```

### Create a checklist
```php
$api->checklists()->create(array $params)
```

### Update a checklist
```php
$api->checklists()->update(string $id, array $params)
```

### Remove a checklist
```php
$api->checklists()->remove(string $id)
```

### Get the board of a given checklist
```php
$api->checklists()->getBoard(string $id, array $params)
```

### Get the field of a board of a given checklist
```php
$api->checklists()->getBoardField(string $id, array $field)
```

### Set a given checklist&#039;s card
```php
$api->checklists()->setCard(string $id, string $cardId)
```

### Set a given checklist&#039;s name
```php
$api->checklists()->setName(string $id, string $name)
```

### Set a given checklist&#039;s position
```php
$api->checklists()->setPosition(string $id, string|integer $position)
```

### Cards API
```php
$api->checklists()->cards()
```

### Items API
```php
$api->checklists()->items()
```

