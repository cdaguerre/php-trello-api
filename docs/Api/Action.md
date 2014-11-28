Trello Action API
======================

### Find an action by id
```php
$api->actions()->show(string $id, array $params)
```

### Update a checklist
```php
$api->actions()->update(string $id, array $params)
```

### Remove a action
```php
$api->actions()->remove(string $id)
```

### Get an action&#039;s board
```php
$api->actions()->getBoard(string $id, array $params)
```

### Get the field of a board of a given card
```php
$api->actions()->getBoardField(string $id, array $field)
```

### Get an action&#039;s list
```php
$api->actions()->getList(string $id, array $params)
```

### Get the field of a list of a given action
```php
$api->actions()->getListField(string $id, array $field)
```

### Get an action&#039;s card
```php
$api->actions()->getCard(string $id, array $params)
```

### Get the field of a card of a given action
```php
$api->actions()->getCardField(string $id, array $field)
```

### Get an action&#039;s member
```php
$api->actions()->getMember(string $id, array $params)
```

### Get the field of a member of a given action
```php
$api->actions()->getMemberField(string $id, array $field)
```

### Get an action&#039;s creator
```php
$api->actions()->getCreator(string $id, array $params)
```

### Get the field of a creator of a given action
```php
$api->actions()->getCreatorField(string $id, array $field)
```

### Get an action&#039;s organization
```php
$api->actions()->getOrganization(string $id, array $params)
```

### Get the field of an organization of a given action
```php
$api->actions()->getOrganizationField(string $id, array $field)
```

### Set a given action&#039;s text
```php
$api->actions()->setText(string $id, string $text)
```

