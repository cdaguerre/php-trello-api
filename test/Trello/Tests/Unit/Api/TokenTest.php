<?php

namespace Trello\Tests\Unit\Api;

/**
 * @group unit
 */
class TokenTest extends TestCase
{
    protected $fakeId = '5461efc60872da1eca5bf45c';
    protected $apiPath = 'tokens';

    /**
     * @test
     */
    public function shouldShowToken()
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
    public function shouldGetMember()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeId.'/member')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getMember($this->fakeId));
    }

    /**
     * @test
     */
    public function shouldGetMemberField()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeId.'/member/fullName')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getMemberField($this->fakeId, 'fullName'));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotGetUnexistingMemberField()
    {
        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('get');

        $api->getMemberField($this->fakeId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetWebhooksApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Token\Webhooks', $api->webhooks());
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Token';
    }
}
