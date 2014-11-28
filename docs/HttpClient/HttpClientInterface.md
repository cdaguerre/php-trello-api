Performs requests on GitHub API. API documentation should be self-explanatory.
======================

### Send a GET request
```php
get(string $path, array $parameters, array $headers)
```

### Send a POST request
```php
post(string $path, mixed $body, array $headers)
```

### Send a PUT request
```php
put(string $path, mixed $body, array $headers)
```

### Send a DELETE request
```php
delete(string $path, mixed $body, array $headers)
```

### Send a request to the server, receive a response,
decode the response and returns an associative array
```php
request(string $path, mixed $body, string $httpMethod, array $headers)
```

### Change an option value.
```php
setOption(string $name, mixed $value)
```

### Set HTTP headers
```php
setHeaders(array $headers)
```

### Authenticate a user for all next requests
```php
authenticate(string $tokenOrLogin, null|string $password, null|string $authMethod)
```

