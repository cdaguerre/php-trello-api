<?php

namespace Trello\Tests\HttpClient;

use Trello\Client;
use Trello\HttpClient\HttpClient;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Client as GuzzleClient;

class HttpClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeAbleToPassOptionsToConstructor()
    {
        $httpClient = new TestHttpClient(array(
            'timeout' => 33,
        ), $this->getBrowserMock());

        $this->assertEquals(33, $httpClient->getOption('timeout'));
        $this->assertEquals(1, $httpClient->getOption('api_version'));
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetOption()
    {
        $httpClient = new TestHttpClient(array(), $this->getBrowserMock());
        $httpClient->setOption('timeout', 666);

        $this->assertEquals(666, $httpClient->getOption('timeout'));
    }

    /**
     * @test
     * @dataProvider getAuthenticationFullData
     */
    public function shouldAuthenticateUsingAllGivenParameters($login, $password, $method)
    {
        $client = new GuzzleClient();
        $listeners = $client->getEventDispatcher()->getListeners('request.before_send');
        $this->assertCount(1, $listeners);

        $httpClient = new TestHttpClient(array(), $client);
        $httpClient->authenticate($login, $password, $method);

        $listeners = $client->getEventDispatcher()->getListeners('request.before_send');
        $this->assertCount(2, $listeners);

        $authListener = $listeners[1][0];
        $this->assertInstanceOf('Trello\HttpClient\Listener\AuthListener', $authListener);
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
     */
    public function shouldDoGETRequest()
    {
        $path       = '/some/path';
        $parameters = array('a' => 'b');
        $headers    = array('c' => 'd');

        $client = $this->getBrowserMock();

        $httpClient = new HttpClient(array(), $client);
        $httpClient->get($path, $parameters, $headers);
    }

    // /**
    //  * @test
    //  */
    // public function shouldDoPOSTRequest()
    // {
    //     $path       = '/some/path';
    //     $body       = 'a = b';
    //     $headers    = array('c' => 'd');

    //     $client = $this->getBrowserMock();
    //     $client->expects($this->once())
    //         ->method('createRequest')
    //         ->with('POST', $path, $this->isType('array'), $body);

    //     $httpClient = new HttpClient(array(), $client);
    //     $httpClient->post($path, $body, $headers);
    // }

    // /**
    //  * @test
    //  */
    // public function shouldDoPOSTRequestWithoutContent()
    // {
    //     $path       = '/some/path';

    //     $client = $this->getBrowserMock();
    //     $client->expects($this->once())
    //         ->method('createRequest')
    //         ->with('POST', $path, $this->isType('array'));

    //     $httpClient = new HttpClient(array(), $client);
    //     $httpClient->post($path);
    // }

    /**
     * @test
     */
    public function shouldDoPATCHRequest()
    {
        $path       = '/some/path';
        $body       = 'a = b';
        $headers    = array('c' => 'd');

        $client = $this->getBrowserMock();

        $httpClient = new HttpClient(array(), $client);
        $httpClient->patch($path, $body, $headers);
    }

    /**
     * @test
     */
    public function shouldDoDELETERequest()
    {
        $path       = '/some/path';
        $body       = 'a = b';
        $headers    = array('c' => 'd');

        $client = $this->getBrowserMock();

        $httpClient = new HttpClient(array(), $client);
        $httpClient->delete($path, $body, $headers);
    }

    /**
     * @test
     */
    public function shouldDoPUTRequest()
    {
        $path       = '/some/path';
        $headers    = array('c' => 'd');

        $client = $this->getBrowserMock();

        $httpClient = new HttpClient(array(), $client);
        $httpClient->put($path, $headers);
    }

    /**
     * @test
     */
    public function shouldDoCustomRequest()
    {
        $path       = '/some/path';
        $body       = 'a = b';
        $options    = array('c' => 'd');

        $client = $this->getBrowserMock();

        $httpClient = new HttpClient(array(), $client);
        $httpClient->request($path, $body, 'HEAD', $options);
    }

    /**
     * @test
     */
    public function shouldAllowToReturnRawContent()
    {
        $path       = '/some/path';
        $parameters = array('a = b');
        $headers    = array('c' => 'd');

        $message = $this->getMockBuilder('Guzzle\Http\Message\Response')
            ->setConstructorArgs(array(200))
            ->setMethods(array('getBody'))
            ->getMock();
        $message->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue('Just raw context'));

        $client = $this->getBrowserMock();
        $client->expects($this->once())
            ->method('send')
            ->will($this->returnValue($message));

        $httpClient = new TestHttpClient(array(), $client);
        $response = $httpClient->get($path, $parameters, $headers);

        $this->assertEquals("Just raw context", $response->getBody());
        $this->assertInstanceOf('Guzzle\Http\Message\MessageInterface', $response);
    }

    protected function getBrowserMock(array $methods = array())
    {
        $mockMethods = array('send', 'createRequest') + $methods;
        $mock = $this->getMockBuilder( 'Guzzle\Http\Client')
            ->setMethods($mockMethods)
            ->getMock();

        $requestMock = $this->getMockBuilder('Guzzle\Http\Message\Request')
            ->setConstructorArgs(array('GET', 'some'))
            ->getMock();

        $mock->expects($this->any())
            ->method('createRequest')
            ->will($this->returnValue($requestMock));

        return $mock;
    }
}

class TestHttpClient extends HttpClient
{
    public function getOption($name, $default = null)
    {
        return isset($this->options[$name]) ? $this->options[$name] : $default;
    }

    public function request($path, $body, $httpMethod = 'GET', array $headers = array(), array $options = array())
    {
        $request = $this->client->createRequest($httpMethod, $path);

        return $this->client->send($request);
    }
}
