
======================

### Get event dispatcher
```php
getEventDispatcher()
```

### Attach an event listener
```php
addListener(string $eventName, callable $listener, integer $priority)
```

### Attach an event subscriber
```php
addEventSubscriber(\Symfony\Component\EventDispatcher\EventSubscriberInterface $subscriber)
```

### Checks whether a given request is a Trello webhook
```php
isTrelloWebhook(\Symfony\Component\HttpFoundation\Request $request)
```

### Checks whether a given request is a Trello webhook
and raises appropriate events @see Events
```php
handleWebhook(\Symfony\Component\HttpFoundation\Request|null $request)
```

