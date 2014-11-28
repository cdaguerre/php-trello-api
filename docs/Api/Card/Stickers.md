Trello Card Stickers API
======================

### Get stickers related to a given card
```php
$api->cards()->stickers()->all(string $id, array $params)
```

### Get a given sticker on a given card
```php
$api->cards()->stickers()->show(string $id, string $stickerId, string|array $fields)
```

### Update a given sticker on a given card
```php
$api->cards()->stickers()->update(string $id, string $stickerId, array $params)
```

### Create a given sticker on a given card
```php
$api->cards()->stickers()->create(string $id, array $params)
```

### Remove a given sticker from a given card
```php
$api->cards()->stickers()->remove(string $id, string $stickerId)
```

