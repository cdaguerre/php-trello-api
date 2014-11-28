Trello Checklist Items API
======================

### Get items related to a given checklist
```php
$api->checklists()->items()->all(string $id, array $params)
```

### Create an item in the given checklist
```php
$api->checklists()->items()->create(string $id, string $name, boolean $checked, array $params)
```

### Remove an item from checklist
```php
$api->checklists()->items()->remove(string $id, string $itemId)
```

