Trello Notification API
======================

### Find a notification by id
```php
$api->notifications()->show(string $id, array $params)
```

### Update a notification
```php
$api->notifications()->update(string $id, array $params)
```

### Set a notification&#039;s unread status
```php
$api->notifications()->setUnread(string $id, boolean $status)
```

### Set all notification&#039;s as read
```php
$api->notifications()->setAllRead()
```

### Get a given notification&#039;s entities
```php
$api->notifications()->getEntities(string $id, array $params)
```

### Get a notification&#039;s board
```php
$api->notifications()->getBoard(string $id, array $params)
```

### Get the field of a board of a given card
```php
$api->notifications()->getBoardField(string $id, array $field)
```

### Get a notification&#039;s list
```php
$api->notifications()->getList(string $id, array $params)
```

### Get the field of a list of a given notification
```php
$api->notifications()->getListField(string $id, array $field)
```

### Get a notification&#039;s card
```php
$api->notifications()->getCard(string $id, array $params)
```

### Get the field of a card of a given notification
```php
$api->notifications()->getCardField(string $id, array $field)
```

### Get a notification&#039;s member
```php
$api->notifications()->getMember(string $id, array $params)
```

### Get the field of a member of a given notification
```php
$api->notifications()->getMemberField(string $id, array $field)
```

### Get a notification&#039;s creator
```php
$api->notifications()->getCreator(string $id, array $params)
```

### Get the field of a creator of a given notification
```php
$api->notifications()->getCreatorField(string $id, array $field)
```

### Get a notification&#039;s organization
```php
$api->notifications()->getOrganization(string $id, array $params)
```

### Get the field of an organization of a given notification
```php
$api->notifications()->getOrganizationField(string $id, array $field)
```

