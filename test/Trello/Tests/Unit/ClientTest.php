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
        return array(
            array('login', 'password', Client::AUTH_HTTP_PASSWORD),
            array('token', null, Client::AUTH_HTTP_TOKEN),
            array('token', null, Client::AUTH_URL_TOKEN),
            array('client_id', 'client_secret', Client::AUTH_URL_CLIENT_ID),
        );
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
        return array(
            array('token', Client::AUTH_HTTP_TOKEN),
            array('token', Client::AUTH_URL_TOKEN),
        );
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function shouldThrowExceptionWhenAuthenticatingWithoutMethodSet()
    {
        $httpClient = $this->getHttpClientMock(array('addListener'));
        $client = new Client($httpClient);
        $client->authenticate('login', null, null);
    }

    /**
     * @test
     */
    public function shouldClearHeadersLazy()
    {
        $httpClient = $this->getHttpClientMock(array('clearHeaders'));
        $httpClient->expects($this->once())->method('clearHeaders');
        $client = new Client($httpClient);
        $client->clearHeaders();
    }

    /**
     * @test
     */
    public function shouldSetHeadersLaizly()
    {
        $headers = array('header1', 'header2');
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
        return array(
            array('action', 'Trello\Api\Action'),
            array('actions', 'Trello\Api\Action'),
            array('board', 'Trello\Api\Board'),
            array('boards', 'Trello\Api\Board'),
            array('card', 'Trello\Api\Card'),
            array('cards', 'Trello\Api\Card'),
            array('checklist', 'Trello\Api\Checklist'),
            array('checklists', 'Trello\Api\Checklist'),
            array('list', 'Trello\Api\Cardlist'),
            array('lists', 'Trello\Api\Cardlist'),
            array('member', 'Trello\Api\Member'),
            array('members', 'Trello\Api\Member'),
            array('notification', 'Trello\Api\Notification'),
            array('notifications', 'Trello\Api\Notification'),
            array('organization', 'Trello\Api\Organization'),
            array('organizations', 'Trello\Api\Organization'),
            array('token', 'Trello\Api\Token'),
            array('tokens', 'Trello\Api\Token'),
            array('webhook', 'Trello\Api\Webhook'),
            array('webhooks', 'Trello\Api\Webhook'),
        );
    }

    public function getHttpClientMock(array $methods = array())
    {
        $methods = array_merge(
            array('get', 'post', 'patch', 'put', 'delete', 'request', 'setOption', 'setHeaders', 'authenticate'),
            $methods
        );

        return $this->getMock('Trello\HttpClient\HttpClientInterface', $methods);
    }
}
