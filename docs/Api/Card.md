Trello Card API
======================

### Find a card by id
```php
$api->cards()->show(string $id, array $params)
```

### Create a card
```php
$api->cards()->create(array $params)
```

### Update a card
```php
$api->cards()->update(string $id, array $params)
```

### Set a given card&#039;s board
```php
$api->cards()->setBoard(string $id, string $boardId)
```

### Get a given card&#039;s board
```php
$api->cards()->getBoard(string $id, array $params)
```

### Get the field of a board of a given card
```php
$api->cards()->getBoardField(string $id, array $field)
```

### Set a given card&#039;s list
```php
$api->cards()->setList(string $id, string $listId)
```

### Get a given card&#039;s list
```php
$api->cards()->getList(string $id, array $params)
```

### Get the field of a list of a given card
```php
$api->cards()->getListField(string $id, array $field)
```

### Set a given card&#039;s name
```php
$api->cards()->setName(string $id, string $name)
```

### Set a given card&#039;s description
```php
$api->cards()->setDescription(string $id, string $description)
```

### Set a given card&#039;s state
```php
$api->cards()->setClosed(string $id, boolean $closed)
```

### Set a given card&#039;s due date
```php
$api->cards()->setDueDate(string $id, \DateTime $date)
```

### Set a given card&#039;s position
```php
$api->cards()->setPosition(string $id, string|integer $position)
```

### Set a given card&#039;s subscription state
```php
$api->cards()->setSubscribed(string $id, boolean $subscribed)
```

### Actions API
```php
$api->cards()->actions()
```

### Attachments API
```php
$api->cards()->attachments()
```

### Checklists API
```php
$api->cards()->checklists()
```

### Labels API
```php
$api->cards()->labels()
```

### Members API
```php
$api->cards()->members()
```

### Stickers API
```php
$api->cards()->stickers()
```

