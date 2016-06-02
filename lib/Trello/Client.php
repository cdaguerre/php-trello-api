<?php

namespace Trello;

use Trello\Api\ApiInterface;
use Trello\Exception\InvalidArgumentException;
use Trello\Exception\BadMethodCallException;
use Trello\HttpClient\HttpClient;
use Trello\HttpClient\HttpClientInterface;

/**
 * Simple PHP Trello client
 *
 * @method Api\Action action()
 * @method Api\Action actions()
 * @method Api\Board board()
 * @method Api\Board boards()
 * @method Api\Card card()
 * @method Api\Card cards()
 * @method Api\Checklist checklist()
 * @method Api\Checklist checklists()
 * @method Api\Cardlist list()
 * @method Api\Cardlist lists()
 * @method Api\Organization organization()
 * @method Api\Organization organizations()
 * @method Api\Member member()
 * @method Api\Member members()
 * @method Api\Token token()
 * @method Api\Token tokens()
 * @method Api\Webhook webhook()
 * @method Api\Webhook webhooks()
 */
class Client implements ClientInterface
{
    /**
     * Constant for authentication method. Indicates the default, but deprecated
     * login with username and token in URL.
     */
    const AUTH_URL_TOKEN = 'url_token';

    /**
     * Constant for authentication method. Not indicates the new login, but allows
     * usage of unauthenticated rate limited requests for given client_id + client_secret
     */
    const AUTH_URL_CLIENT_ID = 'url_client_id';

    /**
     * Constant for authentication method. Indicates the new favored login method
     * with username and password via HTTP Authentication.
     */
    const AUTH_HTTP_PASSWORD = 'http_password';

    /**
     * Constant for authentication method. Indicates the new login method with
     * with username and token via HTTP Authentication.
     */
    const AUTH_HTTP_TOKEN = 'http_token';

    /**
     * @var array
     */
    private $options = array(
        'base_url'    => 'https://api.trello.com/',
        'user_agent'  => 'php-trello-api (http://github.com/cdaguerre/php-trello-api)',
        'timeout'     => 10,
        'api_limit'   => 5000,
        'api_version' => 1,
        'cache_dir'   => null,
    );

    /**
     * The Buzz instance used to communicate with Trello
     *
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * Instantiate a new Trello client
     *
     * @param null|HttpClientInterface $httpClient Trello http client
     */
    public function __construct(HttpClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Get an API by name
     *
     * @param string $name
     *
     * @return ApiInterface
     *
     * @throws InvalidArgumentException if the requested api does not exist
     */
    public function api($name)
    {
        switch ($name) {
            case 'action':
            case 'actions':
                $api = new Api\Action($this);
                break;
            case 'board':
            case 'boards':
                $api = new Api\Board($this);
                break;
            case 'card':
            case 'cards':
                $api = new Api\Card($this);
                break;
            case 'checklist':
            case 'checklists':
                $api = new Api\Checklist($this);
                break;
            case 'list':
            case 'lists':
                $api = new Api\Cardlist($this);
                break;
            case 'member':
            case 'members':
                $api = new Api\Member($this);
                break;
            case 'notification':
            case 'notifications':
                $api = new Api\Notification($this);
                break;
            case 'organization':
            case 'organizations':
                $api = new Api\Organization($this);
                break;
            case 'token':
            case 'tokens':
                $api = new Api\Token($this);
                break;
            case 'webhook':
            case 'webhooks':
                $api = new Api\Webhook($this);
                break;
            default:
                throw new InvalidArgumentException(sprintf('Undefined api called: "%s"', $name));
        }

        return $api;
    }

    /**
     * Authenticate a user for all next requests
     *
     * @param string      $tokenOrLogin Trello private token/username/client ID
     * @param null|string $password     Trello password/secret (optionally can contain $authMethod)
     * @param null|string $authMethod   One of the AUTH_* class constants
     *
     * @throws InvalidArgumentException If no authentication method was given
     */
    public function authenticate($tokenOrLogin, $password = null, $authMethod = null)
    {
        if (null === $password && null === $authMethod) {
            throw new InvalidArgumentException('You need to specify authentication method!');
        }

        if (null === $authMethod && in_array($password, array(self::AUTH_URL_TOKEN, self::AUTH_URL_CLIENT_ID, self::AUTH_HTTP_PASSWORD, self::AUTH_HTTP_TOKEN))) {
            $authMethod = $password;
            $password   = null;
        }

        if (null === $authMethod) {
            $authMethod = self::AUTH_HTTP_PASSWORD;
        }
        $this->getHttpClient()->authenticate($tokenOrLogin, $password, $authMethod);
    }

    /**
     * Get Http Client
     *
     * @return HttpClient
     */
    public function getHttpClient()
    {
        if (null === $this->httpClient) {
            $this->httpClient = new HttpClient($this->options);
        }

        return $this->httpClient;
    }

    /**
     * Set Http Client
     *
     * @param HttpClientInterface $httpClient
     */
    public function setHttpClient(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Clears used headers
     */
    public function clearHeaders()
    {
        $this->getHttpClient()->clearHeaders();
    }

    /**
     * Set headers
     *
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->getHttpClient()->setHeaders($headers);
    }

    /**
     * Get option by name
     *
     * @param string $name the option's name
     *
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    public function getOption($name)
    {
        if (!array_key_exists($name, $this->options)) {
            throw new InvalidArgumentException(sprintf('Undefined option called: "%s"', $name));
        }

        return $this->options[$name];
    }

    /**
     * Set option
     *
     * @param string $name
     * @param mixed  $value
     *
     * @throws InvalidArgumentException if the option is not defined
     * @throws InvalidArgumentException if the api version is set to an unsupported one
     */
    public function setOption($name, $value)
    {
        if (!array_key_exists($name, $this->options)) {
            throw new InvalidArgumentException(sprintf('Undefined option called: "%s"', $name));
        }

        if ('api_version' == $name && !in_array($value, $this->getSupportedApiVersions())) {
            throw new InvalidArgumentException(sprintf('Invalid API version ("%s"), valid are: %s', $name, implode(', ', $supportedApiVersions)));
        }

        $this->options[$name] = $value;
    }

    /**
     * Returns an array of valid API versions supported by this client.
     *
     * @return integer[]
     */
    public function getSupportedApiVersions()
    {
        return array(1);
    }

    /**
     * Proxies $this->members() to $this->api('members')
     *
     * @param string $name method name
     * @param array  $args arguments
     *
     * @return ApiInterface
     *
     * @throws BadMethodCallException
     */
    public function __call($name, $args)
    {
        try {
            return $this->api($name);
        } catch (InvalidArgumentException $e) {
            throw new BadMethodCallException(sprintf('Undefined method called: "%s"', $name));
        }
    }
}
