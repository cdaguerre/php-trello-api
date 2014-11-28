Trello Webhook API
======================

### Find a webhook by id
```php
$api->webhooks()->show(string $id, array $params)
```

### Create a webhook
```php
$api->webhooks()->create(array $params)
```

### Update a webhook
```php
$api->webhooks()->update(string $id, array $params)
```

### Remove a webhook
```php
$api->webhooks()->remove(string $id)
```

### Set a given webhook&#039;s callback url
```php
$api->webhooks()->setCallbackUrl(string $id, string $url)
```

### Set a given webhook&#039;s description
```php
$api->webhooks()->setDescription(string $id, string $description)
```

### Set a given webhook&#039;s board
```php
$api->webhooks()->setModel(string $id, string $modelId)
```

### Set a given webhook&#039;s active state
```php
$api->webhooks()->setActive(string $id, boolean $active)
```

