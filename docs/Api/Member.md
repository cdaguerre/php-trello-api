Trello Member API
======================

### Find a member by id or username
```php
$api->members()->show(string $id, array $params)
```

### Update a member
```php
$api->members()->update(string $id, array $params)
```

### Get a given member&#039;s deltas
```php
$api->members()->getDeltas(string $id, array $params)
```

### Set a given member&#039;s avatarSource
```php
$api->members()->setAvatarSource(string $id, string $avatarSource)
```

### Set a given member&#039;s bio
```php
$api->members()->setBio(string $id, string $bio)
```

### Set a given member&#039;s full name
```php
$api->members()->setFullName(string $id, string $fullName)
```

### Set a given member&#039;s initials
```php
$api->members()->setInitials(string $id, string $initials)
```

### Set a given member&#039;s username
```php
$api->members()->setUsername(string $id, string $username)
```

### Set a given member&#039;s avatar
```php
$api->members()->setAvatar(string $id, $file)
```

### Actions API
```php
$api->members()->actions()
```

### Boards API
```php
$api->members()->boards()
```

### Cards API
```php
$api->members()->cards()
```

### Notifications API
```php
$api->members()->notifications()
```

### Organizations API
```php
$api->members()->organizations()
```

### Custom Backgrounds API
```php
$api->members()->customBackgrounds()
```

### Custom Emoji API
```php
$api->members()->customEmoji()
```

### Custom Stickers API
```php
$api->members()->customStickers()
```

### Saved Searches API
```php
$api->members()->savedSearches()
```

