<?php

namespace Trello\Tests\Unit\Api;

/**
 * @group unit
 */
class ActionTest extends TestCase
{
    protected $apiPath = 'actions';

    /**
     * @test
     */
    public function shouldShowAction()
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
    public function shouldUpdateAction()
    {
        $expectedArray = array('id' => $this->fakeId);

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId)
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->update($this->fakeId, $expectedArray));
    }

    /**
     * @test
     */
    public function shouldRemoveAction()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->apiPath.'/'.$this->fakeId)
            ->will($this->returnValue($this->fakeId));

        $this->assertEquals($this->fakeId, $api->remove($this->fakeId));
    }

    /**
     * @test
     */
    public function shouldSetText()
    {
        $text = 'Lorem Ipsum';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/text')
            ->will($this->returnValue($text));

        $this->assertEquals($text, $api->setText($this->fakeId, $text));
    }

    /**
     * @test
     */
    public function shouldGetBoard()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/board')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getBoard($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetBoardField()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/board/name')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getBoardField($this->fakeParentId, 'name'));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotGetUnexistingBoardField()
    {
        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('get');

        $api->getBoardField($this->fakeParentId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetList()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/list')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getList($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetListField()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/list/name')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getListField($this->fakeParentId, 'name'));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotGetUnexistingListField()
    {
        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('get');

        $api->getListField($this->fakeParentId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetCard()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/card')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getCard($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetCardField()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/card/name')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getCardField($this->fakeParentId, 'name'));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotGetUnexistingCardField()
    {
        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('get');

        $api->getCardField($this->fakeParentId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetMember()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/member')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getMember($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetMemberField()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/member/bio')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getMemberField($this->fakeParentId, 'bio'));
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

        $api->getMemberField($this->fakeParentId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetCreator()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/memberCreator')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getCreator($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetCreatorField()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/memberCreator/bio')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getCreatorField($this->fakeParentId, 'bio'));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotGetUnexistingCreatorField()
    {
        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('get');

        $api->getCreatorField($this->fakeParentId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetOrganization()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/organization')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getOrganization($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetOrganizationField()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeParentId.'/organization/name')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getOrganizationField($this->fakeParentId, 'name'));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotGetUnexistingOrganizationField()
    {
        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('get');

        $api->getOrganizationField($this->fakeParentId, 'unexisting');
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Action';
    }
}
