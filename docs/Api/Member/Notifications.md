Trello Member Notifications API
======================

### Get notifications related to a given list
```php
$api->members()->notifications()->all(string $id, array $params)
```

### Filter notifications related to a given member
```php
$api->members()->notifications()->filter(string $id, array $event)
```

