Performs requests on GitHub API. API documentation should be self-explanatory.
======================

### 
```php
__construct(array $options, \Guzzle\Http\ClientInterface $client)
```

### Change an option value.
```php
setOption($name, $value)
```

### Set HTTP headers
```php
setHeaders(array $headers)
```

### Clears used headers
```php
clearHeaders()
```

### 
```php
addListener($eventName, $listener)
```

### 
```php
addSubscriber(\Symfony\Component\EventDispatcher\EventSubscriberInterface $subscriber)
```

### Send a GET request
```php
get($path, array $parameters, array $headers)
```

### Send a POST request
```php
post($path, $body, array $headers)
```

### {@inheritDoc}
```php
patch($path, $body, array $headers)
```

### Send a DELETE request
```php
delete($path, $body, array $headers)
```

### Send a PUT request
```php
put($path, $body, array $headers)
```

### Send a request to the server, receive a response,
decode the response and returns an associative array
```php
request($path, $body, $httpMethod, array $headers, array $options)
```

### Authenticate a user for all next requests
```php
authenticate($tokenOrLogin, $password, $method)
```

### 
```php
getLastRequest()
```

### 
```php
getLastResponse()
```

