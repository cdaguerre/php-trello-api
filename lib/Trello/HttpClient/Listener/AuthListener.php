<?php

namespace Trello\HttpClient\Listener;

use Guzzle\Common\Event;
use Trello\Client;
use Trello\Exception\RuntimeException;

class AuthListener
{
    private $tokenOrLogin;
    private $password;
    private $method;

    /**
     * @param string $tokenOrLogin
     * @param string $password
     * @param null|string $method
     */
    public function __construct($tokenOrLogin, $password = null, $method)
    {
        $this->tokenOrLogin = $tokenOrLogin;
        $this->password = $password;
        $this->method = $method;
    }

    public function onRequestBeforeSend(Event $event)
    {
        // Skip by default
        if (null === $this->method) {
            return;
        }

        switch ($this->method) {
            case Client::AUTH_HTTP_PASSWORD:
                $event['request']->setHeader(
                    'Authorization',
                    sprintf('Basic %s', base64_encode($this->tokenOrLogin.':'.$this->password))
                );
                break;

            case Client::AUTH_HTTP_TOKEN:
                $event['request']->setHeader(
                    'Authorization',
                    sprintf('token %s', $this->tokenOrLogin)
                );
                break;

            case Client::AUTH_URL_CLIENT_ID:
                $url = $event['request']->getUrl();

                $parameters = array(
                    'key'   => $this->tokenOrLogin,
                    'token' => $this->password,
                );

                $url .= (false === strpos($url, '?') ? '?' : '&');
                $url .= utf8_encode(http_build_query($parameters, '', '&'));

                $event['request']->setUrl($url);
                break;

            case Client::AUTH_URL_TOKEN:
                $url = $event['request']->getUrl();
                $url .= (false === strpos($url, '?') ? '?' : '&');
                $url .= utf8_encode(http_build_query(
                    array('token' => $this->tokenOrLogin, 'key' => $this->password),
                    '',
                    '&'
                ));

                $event['request']->setUrl($url);
                break;

            default:
                throw new RuntimeException(sprintf('%s not yet implemented', $this->method));
        }
    }
}
