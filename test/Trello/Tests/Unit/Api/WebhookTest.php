<?php

namespace Trello\Tests\Unit\Api;

/**
 * @group unit
 */
class WebhookTest extends TestCase
{
    protected $fakeId = '5461efc60872da1eca5bf45c';
    protected $apiPath = 'webhooks';

    /**
     * @test
     */
    public function shouldShowWebhook()
    {
        $expectedArray = array('id' => $this->fakeId);

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeId)
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->show($this->fakeId));
    }

    /**
     * @test
     */
    public function shouldRemoveToken()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->apiPath.'/'.$this->fakeId)
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->remove($this->fakeId));
    }

    /**
     * @test
     */
    public function shouldSetDescription()
    {
        $description = 'Test Webhook Description';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/description')
            ->will($this->returnValue($description));

        $this->assertEquals($description, $api->setDescription($this->fakeId, $description));
    }

    /**
     * @test
     */
    public function shouldSetCallbackUrl()
    {
        $description = 'Test Webhook CallbackUrl';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/callbackUrl')
            ->will($this->returnValue($description));

        $this->assertEquals($description, $api->setCallbackUrl($this->fakeId, $description));
    }

    /**
     * @test
     */
    public function shouldSetModel()
    {
        $modelId = $this->fakeId('webhook');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/idModel')
            ->will($this->returnValue($modelId));

        $this->assertEquals($modelId, $api->setModel($this->fakeId, $modelId));
    }

    /**
     * @test
     */
    public function shouldSetActive()
    {
        $status = true;

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/active')
            ->will($this->returnValue($status));

        $this->assertEquals($status, $api->setActive($this->fakeId, $status));
    }

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
            ->with($this->apiPath)
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->create($expectedArray));
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

        $api->create($data);
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

        $api->create($data);
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
            ->with($this->apiPath.'/'.$this->fakeId)
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->update($this->fakeId, $expectedArray));
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

        $api->update($this->fakeId, $data);
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

        $api->update($this->fakeId, $data);
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Webhook';
    }
}
