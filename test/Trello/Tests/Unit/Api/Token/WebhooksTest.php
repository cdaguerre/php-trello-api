<?php

namespace Trello\Tests\Unit\Api\Token;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class WebhooksTest extends TestCase
{
    protected $apiPath = 'tokens/#id#/webhooks';

    /**
     * @test
     */
    public function shouldCreateWebhook()
    {
        $expectedArray = array(
            'callbackURL' => 'http://www.callback.com/',
            'idModel' => $this->fakeId('board')
        );

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->create($this->fakeParentId, $expectedArray));
    }

    /**
     * @test
     * @expectedException Trello\Exception\MissingArgumentException
     */
    public function shouldNotCreateWebhookWithoutCallbackUrl()
    {
        $data = array(
            'idModel' => $this->fakeId('board')
        );

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->create($this->fakeId, $data);
    }

    /**
     * @test
     * @expectedException Trello\Exception\MissingArgumentException
     */
    public function shouldNotCreateWebhookWithoutModelId()
    {
        $data = array(
            'callbackUrl' => 'http://www.callback.com/'
        );

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->create($this->fakeId, $data);
    }

    /**
     * @test
     */
    public function shouldUpdateWebhook()
    {
        $expectedArray = array(
            'callbackURL' => 'http://www.callback.com/',
            'idModel' => $this->fakeId('board')
        );

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->getPath())
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->update($this->fakeParentId, $expectedArray));
    }

    /**
     * @test
     * @expectedException Trello\Exception\MissingArgumentException
     */
    public function shouldNotUpdateWebhookWithoutCallbackUrl()
    {
        $data = array(
            'idModel' => $this->fakeId('board')
        );

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->update($this->fakeParentId, $data);
    }

    /**
     * @test
     * @expectedException Trello\Exception\MissingArgumentException
     */
    public function shouldNotUpdateWebhookWithoutModelId()
    {
        $data = array(
            'callbackUrl' => 'http://www.callback.com/'
        );

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->update($this->fakeParentId, $data);
    }

    /**
     * @test
     */
    public function shouldRemoveWebhook()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId)
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->remove($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldGetAllWebhooks()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath())
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->all($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldShowWebhook()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/'.$this->fakeId)
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->show($this->fakeParentId, $this->fakeId));
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Token\Webhooks';
    }
}
