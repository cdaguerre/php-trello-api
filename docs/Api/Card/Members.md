Trello Card Members API
======================

### Get members related to a given card
```php
$api->cards()->members()->all(string $id, array $params)
```

### Set members of a given card
```php
$api->cards()->members()->set(string $id, array $members)
```

### Add a member to a given card
```php
$api->cards()->members()->add(string $id, array $memberId)
```

### Remove a given member from a given card
```php
$api->cards()->members()->remove(string $id, string $memberId)
```

### Add a given member&#039;s vote to a given card
```php
$api->cards()->members()->addVote(string $id, string $memberId)
```

### Remove a given member&#039;s vote from a given card
```php
$api->cards()->members()->removeVote(string $id, string $memberId)
```

