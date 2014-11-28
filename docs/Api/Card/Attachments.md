Trello Card Attachments API
======================

### Get attachments related to a given card
```php
$api->cards()->attachments()->all(string $id, array $params)
```

### Add an attachment to a given card
```php
$api->cards()->attachments()->create(string $id, array $params)
```

### Get a given attachment on a given card
```php
$api->cards()->attachments()->show(string $id, string $attachmentId)
```

### Remove a given attachment from a given card
```php
$api->cards()->attachments()->remove(string $id, string $attachmentId)
```

### Set a given attachment as cover of a given card
```php
$api->cards()->attachments()->setAsCover(string $id, string $attachmentId)
```

