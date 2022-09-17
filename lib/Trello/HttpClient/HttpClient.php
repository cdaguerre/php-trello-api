<?php

namespace Trello\HttpClient;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Trello\Client;
use Trello\Exception\ErrorException;
use Trello\Exception\RuntimeException;
use Trello\HttpClient\Listener\AuthListener;
use Trello\HttpClient\Listener\ErrorListener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Trello\HttpClient\Message\ResponseMediator;

class HttpClient implements HttpClientInterface
{
    protected $options = [
        'base_uri'    => 'https://api.trello.com/',
        'user_agent'  => 'php-trello-api (http://github.com/cdaguerre/php-trello-api)',
        'timeout'     => 10,
        'api_version' => 1,
    ];

    /**
     * @var ClientInterface
     */
    protected $client;

    protected $headers = [];

    /**
     * @var array
     */
    protected $middlewares = [];

    /**
     * @var \GuzzleHttp\HandlerStack
     */
    protected $handlerStack;

    private $lastResponse;
    private $lastRequest;

    /**
     * @param array           $options
     * @param ClientInterface $client
     */
    public function __construct(array $options = [], ClientInterface $client = null)
    {
        $this->options = array_merge($this->options, $options);
        $client = $client ?: new GuzzleClient($this->options);
        $this->client = $client;
        $this->pushMiddleware($this->errorMiddleware());

        $this->clearHeaders();
    }

    /**
     * {@inheritDoc}
     */
    public function setOption($name, $value)
    {
        $this->options[ $name ] = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function setHeaders(array $headers)
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    /**
     * Clears used headers
     */
    public function clearHeaders()
    {
        $this->headers = [
            'Accept'     => sprintf('application/vnd.orcid.%s+json', $this->options['api_version']),
            'User-Agent' => sprintf('%s', $this->options['user_agent']),
        ];
    }

    /**
     * @param \GuzzleHttp\HandlerStack $handlerStack
     *
     * @return $this
     */
    public function setHandlerStack(HandlerStack $handlerStack)
    {
        $this->handlerStack = $handlerStack;

        return $this;
    }

    /**
     * Build a handler stack.
     *
     * @return \GuzzleHttp\HandlerStack
     */
    public function getHandlerStack()
    {
        if ($this->handlerStack) {
            return $this->handlerStack;
        }

        $this->handlerStack = HandlerStack::create();

        foreach ($this->middlewares as $name => $middleware) {
            $this->handlerStack->push($middleware, $name);
        }

        return $this->handlerStack;
    }

    /**
     * Add a middleware.
     *
     * @param callable    $middleware
     * @param null|string $name
     *
     * @return $this
     */
    public function pushMiddleware(callable $middleware, string $name = null)
    {
        if (!is_null($name)) {
            $this->middlewares[ $name ] = $middleware;
        } else {
            array_push($this->middlewares, $middleware);
        }

        return $this;
    }

    /**
     * Return all middlewares.
     *
     * @return array
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    /**
     * {@inheritDoc}
     */
    public function get($path, array $parameters = [], array $headers = [])
    {
        return $this->request($path, $parameters, 'GET', $headers);
    }

    /**
     * {@inheritDoc}
     */
    public function post($path, $body = null, array $headers = [])
    {
        if (!isset($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        }

        return $this->request($path, $body, 'POST', $headers);
    }

    /**
     * {@inheritDoc}
     */
    public function patch($path, $body = null, array $headers = [])
    {
        if (!isset($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        }

        return $this->request($path, $body, 'PATCH', $headers);
    }

    /**
     * {@inheritDoc}
     */
    public function delete($path, $body = null, array $headers = [])
    {
        return $this->request($path, $body, 'DELETE', $headers);
    }

    /**
     * {@inheritDoc}
     */
    public function put($path, $body, array $headers = [])
    {
        if (!isset($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        }

        return $this->request($path, $body, 'PUT', $headers);
    }

    /**
     * {@inheritDoc}
     */
    public function request($path, $body = null, $httpMethod = 'GET', array $headers = [], array $options = [])
    {
        $request = $this->createRequest($httpMethod, $path, $body, $headers, $options);

        $options = array_merge($this->options, ['handler' => $this->getHandlerStack()]);

        try {
            $response = $this->client->send($request, $options);
        } catch (\LogicException $e) {
            throw new ErrorException($e->getMessage(), $e->getCode(), $e);
        } catch (\RuntimeException $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }

        $this->lastRequest = $request;
        $this->lastResponse = $response;

        return $response;
    }

    protected function errorMiddleware()
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                return $handler($request, $options)->then(
                    function ($response) {
                        if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
                            return $response;
                        }

                        switch ($response->getStatusCode()) {
                            case 429:
                                throw new ApiLimitExceedException('Wait a second.', 429);
                                break;
                        }

                        $content = ResponseMediator::getContent($response);
                        if (is_array($content) && isset($content['message'])) {
                            if (400 == $response->getStatusCode()) {
                                throw new ErrorException($content['message'], 400);
                            }

                            if (401 == $response->getStatusCode()) {
                                throw new PermissionDeniedException($content['message'], 401);
                            }

                            if (422 == $response->getStatusCode() && isset($content['errors'])) {
                                $errors = [];
                                foreach ($content['errors'] as $error) {
                                    switch ($error['code']) {
                                        case 'missing':
                                            $errors[] = sprintf('The %s %s does not exist, for resource "%s"', $error['field'], $error['value'], $error['resource']);
                                            break;

                                        case 'missing_field':
                                            $errors[] = sprintf('Field "%s" is missing, for resource "%s"', $error['field'], $error['resource']);
                                            break;

                                        case 'invalid':
                                            $errors[] = sprintf('Field "%s" is invalid, for resource "%s"', $error['field'], $error['resource']);
                                            break;

                                        case 'already_exists':
                                            $errors[] = sprintf('Field "%s" already exists, for resource "%s"', $error['field'], $error['resource']);
                                            break;

                                        default:
                                            $errors[] = $error['message'];
                                            break;

                                    }
                                }

                                throw new ValidationFailedException('Validation Failed: ' . implode(', ', $errors), 422);
                            }
                        }

                        throw new RuntimeException(isset($content['message']) ? $content['message'] : $content, $response->getStatusCode());
                    }
                );
            };
        };
    }

    /**
     * {@inheritDoc}
     */
    protected function onRequestError(ResponseInterface $response)
    {

    }

    /**
     * Attache access token to request query.
     *
     * @return \Closure
     */
    protected function authenticateMiddleware($tokenOrLogin, $password = null, $method)
    {
        return function (callable $handler) use ($tokenOrLogin, $password, $method) {
            return function (RequestInterface $request, array $options) use ($handler, $tokenOrLogin, $password, $method) {
                if (null === $method) {
                    return;
                }

                switch ($method) {
                    case Client::AUTH_HTTP_PASSWORD:
                        $this->withHeader(
                            'Authorization',
                            sprintf('Basic %s', base64_encode($tokenOrLogin . ':' . $password))
                        );
                        break;
                    case Client::AUTH_HTTP_TOKEN:
                        $this->withHeader(
                            'Authorization',
                            sprintf('token %s', $tokenOrLogin)
                        );
                        break;

                    case Client::AUTH_URL_CLIENT_ID:
                        $query = [
                            'key'   => $tokenOrLogin,
                            'token' => $password
                        ];
                        $originalQueryString = $request->getUri()->getQuery();
                        $originalQuery = [];
                        parse_str($originalQueryString, $originalQuery);
                        $query = array_merge($originalQuery, $query);

                        $query = http_build_query($query);
                        $request = $request->withUri($request->getUri()->withQuery($query));
                        break;

                    case Client::AUTH_URL_TOKEN:
                        $query = [
                            'token' => $tokenOrLogin,
                            'key' => $password
                        ];
                        $originalQueryString = $request->getUri()->getQuery();
                        $originalQuery = [];
                        parse_str($originalQueryString, $originalQuery);
                        $query = array_merge($originalQuery, $query);

                        $query = http_build_query($query);
                        $request = $request->withUri($request->getUri()->withQuery($query));
                        break;

                    default:
                        throw new RuntimeException(sprintf('%s not yet implemented', $method));
                }

                return $handler($request, $options);
            };
        };
    }

    /**
     * {@inheritDoc}
     */
    public function authenticate($tokenOrLogin, $password = null, $method)
    {
        $this->pushMiddleware($this->authenticateMiddleware($tokenOrLogin, $password, $method), 'authenticate');
    }

    /**
     * @return Request
     */
    public function getLastRequest()
    {
        return $this->lastRequest;
    }

    /**
     * @return Response
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * @param string $httpMethod
     * @param string $path
     */
    protected function createRequest($httpMethod, $path, $body = null, array $headers = [], array $options = [])
    {
        $path = $this->options['api_version'] . '/' . $path;

        if ($httpMethod === 'GET' && $body) {
            $path .= (false === strpos($path, '?') ? '?' : '&');
            $path .= utf8_encode(http_build_query($body, '', '&'));
        }

        return new Request(
            $httpMethod,
            $path,
            array_merge($this->headers, $headers),
            utf8_encode(http_build_query($body, '', '&'))
        );
    }
}
