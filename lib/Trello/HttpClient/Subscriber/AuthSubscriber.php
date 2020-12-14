<?php

namespace Trello\HttpClient\Subscriber;

use GuzzleHttp\Event\BeforeEvent;
use Trello\Client;
use Trello\Exception\RuntimeException;
use GuzzleHttp\Event\SubscriberInterface;

/**
 * Class AuthSubscriber
 * @package Trello\HttpClient\Subscriber
 */
class AuthSubscriber implements SubscriberInterface
{
    private $tokenOrLogin;
    private $password;
    private $method;

    /**
     * @param string $tokenOrLogin
     * @param string $password
     * @param null|string $method
     */
    public function __construct($tokenOrLogin, $password, $method)
    {
        $this->tokenOrLogin = $tokenOrLogin;
        $this->password = $password ?: null;
        $this->method = $method;
    }

    /**
     * @inheritDoc
     */
    public function getEvents()
    {
        return [
            'before' => ['onRequestBeforeSend'] /** @see AuthSubscriber::onRequestBeforeSend() */
        ];
    }

    /**
     * @param BeforeEvent $event
     */
    public function onRequestBeforeSend(BeforeEvent $event)
    {
        $request = $event->getRequest();

        // Skip by default
        if (null === $this->method) {
            return;
        }

        switch ($this->method) {
            case Client::AUTH_HTTP_PASSWORD:
                $request->setHeader(
                    'Authorization',
                    sprintf('Basic %s', base64_encode($this->tokenOrLogin . ':' . $this->password))
                );
                break;

            case Client::AUTH_HTTP_TOKEN:
                $request->setHeader(
                    'Authorization',
                    sprintf('token %s', $this->tokenOrLogin)
                );
                break;

            case Client::AUTH_URL_CLIENT_ID:
                $url = $request->getUrl();

                $parameters = [
                    'key' => $this->tokenOrLogin,
                    'token' => $this->password,
                ];

                $url .= (false === strpos($url, '?') ? '?' : '&');
                $url .= utf8_encode(http_build_query($parameters, '', '&'));

                $request->setUrl($url);
                break;

            case Client::AUTH_URL_TOKEN:
                $url = $request->getUrl();
                $url .= (false === strpos($url, '?') ? '?' : '&');
                $url .= utf8_encode(http_build_query(
                    ['token' => $this->tokenOrLogin, 'key' => $this->password],
                    '',
                    '&'
                ));

                $request->setUrl($url);
                break;

            default:
                throw new RuntimeException(sprintf('%s not yet implemented', $this->method));
        }
    }
}
