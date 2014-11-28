Simple PHP Trello client
======================

```php
const AUTH_URL_TOKEN = 'url_token'
```
Constant for authentication method. Indicates the default, but deprecated
login with username and token in URL.



```php
const AUTH_URL_CLIENT_ID = 'url_client_id'
```
Constant for authentication method. Not indicates the new login, but allows
usage of unauthenticated rate limited requests for given client_id + client_secret



```php
const AUTH_HTTP_PASSWORD = 'http_password'
```
Constant for authentication method. Indicates the new favored login method
with username and password via HTTP Authentication.



```php
const AUTH_HTTP_TOKEN = 'http_token'
```
Constant for authentication method. Indicates the new login method with
with username and token via HTTP Authentication.



### Instantiate a new Trello client
```php
__construct(null|\Trello\HttpClient\HttpClientInterface $httpClient)
```

### Get an API by name
```php
api(string $name)
```

### Authenticate a user for all next requests
```php
authenticate(string $tokenOrLogin, null|string $password, null|string $authMethod)
```

### Get Http Client
```php
getHttpClient()
```

### Set Http Client
```php
setHttpClient(\Trello\HttpClient\HttpClientInterface $httpClient)
```

### Clears used headers
```php
clearHeaders()
```

### Set headers
```php
setHeaders(array $headers)
```

### Get option by name
```php
getOption(string $name)
```

### Set option
```php
setOption(string $name, mixed $value)
```

### Returns an array of valid API versions supported by this client.
```php
getSupportedApiVersions()
```

### Proxies $this-&gt;members() to $this-&gt;api(&#039;members&#039;)
```php
__call(string $name, array $args)
```

### 
```php
action()
```

### 
```php
actions()
```

### 
```php
board()
```

### 
```php
boards()
```

### 
```php
card()
```

### 
```php
cards()
```

### 
```php
checklist()
```

### 
```php
checklists()
```

### 
```php
list()
```

### 
```php
lists()
```

### 
```php
organization()
```

### 
```php
organizations()
```

### 
```php
member()
```

### 
```php
members()
```

### 
```php
token()
```

### 
```php
tokens()
```

### 
```php
webhook()
```

### 
```php
webhooks()
```

