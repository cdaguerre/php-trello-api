Trello Card Actions API
======================

### Get actions related to a given card
```php
$api->cards()->actions()->all(string $id, array $params)
```

### Add comment to a given card
```php
$api->cards()->actions()->addComment(string $id, string $text)
```

### Remove comment to a given card
```php
$api->cards()->actions()->removeComment(string $id, string $commentId)
```

