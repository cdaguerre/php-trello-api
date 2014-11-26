<?php

namespace Trello\Tests\Unit\Api;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    protected $fakeId = '5461efc60872da1eca5bf45c';
    protected $fakeParentId = '5461efc60872da1eca5bf45d';

    abstract protected function getApiClass();

    protected function fakeId($model = 'any')
    {
        return md5($model);
    }

    protected function getPath()
    {
        return preg_replace('/\#id\#/', $this->fakeParentId, $this->apiPath);
    }

    protected function getApiMock()
    {
        $httpClient = $this->getMock('Guzzle\Http\Client', array('send'));
        $httpClient
            ->expects($this->any())
            ->method('send');

        $mock = $this->getMock('Trello\HttpClient\HttpClient', array(), array(array(), $httpClient));

        $client = new \Trello\Client($mock);
        $client->setHttpClient($mock);

        return $this->getMockBuilder($this->getApiClass())
            ->setMethods(array('get', 'post', 'postRaw', 'patch', 'delete', 'put', 'head'))
            ->setConstructorArgs(array($client))
            ->getMock();
    }
}
