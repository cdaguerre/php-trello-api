Trello Board API
======================

### Find a board by id
```php
$api->boards()->show(string $id, array $params)
```

### Create a board
```php
$api->boards()->create(array $params)
```

### Update a board
```php
$api->boards()->update(string $id, array $params)
```

### Set a given board&#039;s name
```php
$api->boards()->setName(string $id, string $name)
```

### Set a given board&#039;s description
```php
$api->boards()->setDescription(string $id, string $description)
```

### Set a given board&#039;s state
```php
$api->boards()->setClosed(string $id, boolean $closed)
```

### Set a given board&#039;s subscription state
```php
$api->boards()->setSubscribed(string $id, boolean $subscribed)
```

### Set a given board&#039;s organization
```php
$api->boards()->setOrganization(string $id, string $organizationId)
```

### Get a given board&#039;s organization
```php
$api->boards()->getOrganization(string $id, array $params)
```

### Get the field of the organization of a given board
```php
$api->boards()->getOrganizationField(string $id, string $field)
```

### Get a given board&#039;s stars
```php
$api->boards()->getStars(string $id, array $params)
```

### Get a given board&#039;s deltas
```php
$api->boards()->getDeltas(string $id, array $params)
```

### Mark a given board as viewed
```php
$api->boards()->setViewed(string $id)
```

### Board Actions API
```php
$api->boards()->actions()
```

### Board Lists API
```php
$api->boards()->lists()
```

### Board Cards API
```php
$api->boards()->cards()
```

### Board Checklists API
```php
$api->boards()->checklists()
```

### Board Labels API
```php
$api->boards()->labels()
```

### Board Members API
```php
$api->boards()->members()
```

### Board Memberships API
```php
$api->boards()->memberships()
```

### Board Preferences API
```php
$api->boards()->preferences()
```

### Board MyPreferences API
```php
$api->boards()->myPreferences()
```

### Board PowerUps API
```php
$api->boards()->powerUps()
```

