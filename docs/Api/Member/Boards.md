Trello Member Boards API
======================

### Get boads related to a given member
```php
$api->members()->boards()->all(string $id, array $params)
```

### Filter boards related to a given member
```php
$api->members()->boards()->filter(string $id, string|array $filter)
```

### Get boads a given member is invited to
```php
$api->members()->boards()->invitedTo(string $id, array $params)
```

### Get a field of a boad a given member is invited to
```php
$api->members()->boards()->invitedToField(string $id, $field)
```

### Pin a boad for a given member
```php
$api->members()->boards()->pin(string $id, string $boardId)
```

### Unpin a boad for a given member
```php
$api->members()->boards()->unpin(string $id, string $boardId)
```

### Board Backgrounds API
```php
$api->members()->boards()->backgrounds()
```

### Board Stars API
```php
$api->members()->boards()->stars()
```

