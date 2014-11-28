Trello Card Checklists API
======================

### Get checklists related to a given card
```php
$api->cards()->checklists()->all(string $id, array $params)
```

### Add a checklist to a given card
```php
$api->cards()->checklists()->create(string $id, array $params)
```

### Remove a given checklist from a given card
```php
$api->cards()->checklists()->remove(string $id, string $checklistId)
```

### Get a given card&#039;s checklist item states
```php
$api->cards()->checklists()->itemStates(string $id, array $params)
```

