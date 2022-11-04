<?php

namespace Github\Tests;

use Trello\Client;
use Trello\Exception\InvalidArgumentException;
use Trello\Exception\BadMethodCallException;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldNotHaveToPassHttpClientToConstructor()
    {
        $client = new Client();
        $this->assertInstanceOf('Trello\HttpClient\HttpClient', $client->getHttpClient());
    }

    /**
     * @test
     */
    public function shouldPassHttpClientInterfaceToConstructor()
    {
        $client = new Client($this->getHttpClientMock());
        $this->assertInstanceOf('Trello\HttpClient\HttpClientInterface', $client->getHttpClient());
    }

    /**
     * @test
     * @dataProvider getAuthenticationFullData
     */
    public function shouldAuthenticateUsingAllGivenParameters($login, $password, $method)
    {
        $httpClient = $this->getHttpClientMock();
        $httpClient->expects($this->once())
            ->method('authenticate')
            ->with($login, $password, $method);
        $client = new Client($httpClient);
        $client->authenticate($login, $password, $method);
    }

    public function getAuthenticationFullData()
    {
        return [
            ['login', 'password', Client::AUTH_HTTP_PASSWORD],
            ['token', null, Client::AUTH_HTTP_TOKEN],
            ['token', null, Client::AUTH_URL_TOKEN],
            ['client_id', 'client_secret', Client::AUTH_URL_CLIENT_ID],
        ];
    }

    /**
     * @test
     * @dataProvider getAuthenticationPartialData
     */
    public function shouldAuthenticateUsingGivenParameters($token, $method)
    {
        $httpClient = $this->getHttpClientMock();
        $httpClient->expects($this->once())
            ->method('authenticate')
            ->with($token, null, $method);
        $client = new Client($httpClient);
        $client->authenticate($token, $method);
    }

    public function getAuthenticationPartialData()
    {
        return [
            ['token', Client::AUTH_HTTP_TOKEN],
            ['token', Client::AUTH_URL_TOKEN],
        ];
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function shouldThrowExceptionWhenAuthenticatingWithoutMethodSet()
    {
        $httpClient = $this->getHttpClientMock(['addListener']);
        $client = new Client($httpClient);
        $client->authenticate('login', null, null);
    }

    /**
     * @test
     */
    public function shouldClearHeadersLazy()
    {
        $httpClient = $this->getHttpClientMock(['clearHeaders']);
        $httpClient->expects($this->once())->method('clearHeaders');
        $client = new Client($httpClient);
        $client->clearHeaders();
    }

    /**
     * @test
     */
    public function shouldSetHeadersLaizly()
    {
        $headers = ['header1', 'header2'];
        $httpClient = $this->getHttpClientMock();
        $httpClient->expects($this->once())->method('setHeaders')->with($headers);
        $client = new Client($httpClient);
        $client->setHeaders($headers);
    }

    /**
     * @test
     * @dataProvider getApiClassesProvider
     */
    public function shouldGetApiInstance($apiName, $class)
    {
        $client = new Client();
        $this->assertInstanceOf($class, $client->api($apiName));
    }

    /**
     * @test
     * @dataProvider getApiClassesProvider
     */
    public function shouldGetMagicApiInstance($apiName, $class)
    {
        $client = new Client();
        $this->assertInstanceOf($class, $client->$apiName());
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function shouldNotGetApiInstance()
    {
        $client = new Client();
        $client->api('do_not_exist');
    }

    /**
     * @test
     * @expectedException BadMethodCallException
     */
    public function shouldNotGetMagicApiInstance()
    {
        $client = new Client();
        $client->doNotExist();
    }

    public function getApiClassesProvider()
    {
        return [
            ['action', 'Trello\Api\Action'],
            ['actions', 'Trello\Api\Action'],
            ['board', 'Trello\Api\Board'],
            ['boards', 'Trello\Api\Board'],
            ['card', 'Trello\Api\Card'],
            ['cards', 'Trello\Api\Card'],
            ['checklist', 'Trello\Api\Checklist'],
            ['checklists', 'Trello\Api\Checklist'],
            ['list', 'Trello\Api\Cardlist'],
            ['lists', 'Trello\Api\Cardlist'],
            ['member', 'Trello\Api\Member'],
            ['members', 'Trello\Api\Member'],
            ['notification', 'Trello\Api\Notification'],
            ['notifications', 'Trello\Api\Notification'],
            ['organization', 'Trello\Api\Organization'],
            ['organizations', 'Trello\Api\Organization'],
            ['token', 'Trello\Api\Token'],
            ['tokens', 'Trello\Api\Token'],
            ['webhook', 'Trello\Api\Webhook'],
            ['webhooks', 'Trello\Api\Webhook'],
        ];
    }

    public function getHttpClientMock(array $methods = [])
    {
        $methods = array_merge(
            ['get', 'post', 'patch', 'put', 'delete', 'request', 'setOption', 'setHeaders', 'authenticate'],
            $methods
        );

        return $this->getMockBuilder('Trello\HttpClient\HttpClientInterface')
            ->setMethods($methods)
            ->getMock();
    }
}
