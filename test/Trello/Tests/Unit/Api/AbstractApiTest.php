<?php

namespace Trello\Tests\Api;

use Trello\Api\AbstractApi;

class AbstractApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldPassGETRequestToClient()
    {
        $expectedArray = ['value'];

        $httpClient = $this->getHttpMock();
        $httpClient
            ->expects($this->any())
            ->method('get')
            ->with('/path', ['param1' => 'param1value'], ['header1' => 'header1value'])
            ->will($this->returnValue($expectedArray));
        $client = $this->getClientMock();
        $client->setHttpClient($httpClient);

        $api = $this->getAbstractApiObject($client);

        $this->assertEquals($expectedArray, $api->get('/path', ['param1' => 'param1value'], ['header1' => 'header1value']));
    }

    /**
     * @test
     */
    public function shouldPassPOSTRequestToClient()
    {
        $expectedArray = ['value'];

        $httpClient = $this->getHttpMock();
        $httpClient
            ->expects($this->once())
            ->method('post')
            ->with('/path', ['param1' => 'param1value'], ['option1' => 'option1value'])
            ->will($this->returnValue($expectedArray));
        $client = $this->getClientMock();
        $client->setHttpClient($httpClient);

        $api = $this->getAbstractApiObject($client);

        $this->assertEquals($expectedArray, $api->post('/path', ['param1' => 'param1value'], ['option1' => 'option1value']));
    }

    /**
     * @test
     */
    public function shouldPassPATCHRequestToClient()
    {
        $expectedArray = ['value'];

        $httpClient = $this->getHttpMock();
        $httpClient
            ->expects($this->once())
            ->method('patch')
            ->with('/path', ['param1' => 'param1value'], ['option1' => 'option1value'])
            ->will($this->returnValue($expectedArray));
        $client = $this->getClientMock();
        $client->setHttpClient($httpClient);

        $api = $this->getAbstractApiObject($client);

        $this->assertEquals($expectedArray, $api->patch('/path', ['param1' => 'param1value'], ['option1' => 'option1value']));
    }

    /**
     * @test
     */
    public function shouldPassPUTRequestToClient()
    {
        $expectedArray = ['value'];

        $httpClient = $this->getHttpMock();
        $httpClient
            ->expects($this->once())
            ->method('put')
            ->with('/path', ['param1' => 'param1value'], ['option1' => 'option1value'])
            ->will($this->returnValue($expectedArray));
        $client = $this->getClientMock();
        $client->setHttpClient($httpClient);

        $api = $this->getAbstractApiObject($client);

        $this->assertEquals($expectedArray, $api->put('/path', ['param1' => 'param1value'], ['option1' => 'option1value']));
    }

    /**
     * @test
     */
    public function shouldPassDELETERequestToClient()
    {
        $expectedArray = ['value'];

        $httpClient = $this->getHttpMock();
        $httpClient
            ->expects($this->once())
            ->method('delete')
            ->with('/path', ['param1' => 'param1value'], ['option1' => 'option1value'])
            ->will($this->returnValue($expectedArray));
        $client = $this->getClientMock();
        $client->setHttpClient($httpClient);

        $api = $this->getAbstractApiObject($client);

        $this->assertEquals($expectedArray, $api->delete('/path', ['param1' => 'param1value'], ['option1' => 'option1value']));
    }

    protected function getAbstractApiObject($client)
    {
        return new AbstractApiTestInstance($client);
    }

    /**
     * @return \Trello\Client
     */
    protected function getClientMock()
    {
        return new \Trello\Client($this->getHttpMock());
    }

    /**
     * @return \Trello\HttpClient\HttpClientInterface
     */
    protected function getHttpMock()
    {
        return $this->getMockBuilder('Trello\HttpClient\HttpClient')
            ->setConstructorArgs([
                [],
                $this->getHttpClientMock()
            ])
            ->getMock();
    }

    protected function getHttpClientMock()
    {
        $mock = $this->getMockBuilder('GuzzleHttp\Client')
            ->setMethods(['send'])
            ->getMock();
        $mock->expects($this->any())
            ->method('send');

        return $mock;
    }
}

class AbstractApiTestInstance extends AbstractApi
{
    /**
     * {@inheritDoc}
     */
    public function get($path, array $parameters = [], $requestHeaders = [])
    {
        return $this->client->getHttpClient()->get($path, $parameters, $requestHeaders);
    }

    /**
     * {@inheritDoc}
     */
    public function post($path, array $parameters = [], $requestHeaders = [])
    {
        return $this->client->getHttpClient()->post($path, $parameters, $requestHeaders);
    }

    /**
     * {@inheritDoc}
     */
    public function postRaw($path, $body, $requestHeaders = [])
    {
        return $this->client->getHttpClient()->post($path, $body, $requestHeaders);
    }

    /**
     * {@inheritDoc}
     */
    public function patch($path, array $parameters = [], $requestHeaders = [])
    {
        return $this->client->getHttpClient()->patch($path, $parameters, $requestHeaders);
    }

    /**
     * {@inheritDoc}
     */
    public function put($path, array $parameters = [], $requestHeaders = [])
    {
        return $this->client->getHttpClient()->put($path, $parameters, $requestHeaders);
    }

    /**
     * {@inheritDoc}
     */
    public function delete($path, array $parameters = [], $requestHeaders = [])
    {
        return $this->client->getHttpClient()->delete($path, $parameters, $requestHeaders);
    }
}

class ExposedAbstractApiTestInstance extends AbstractApi
{
    /**
     * {@inheritDoc}
     */
    public function get($path, array $parameters = [], $requestHeaders = [])
    {
        return parent::get($path, $parameters, $requestHeaders);
    }
}
