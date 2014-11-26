<?php

namespace Trello\Tests\Unit\Api;

/**
 * @group unit
 */
class CardTest extends TestCase
{
    protected $fakeCardId = '5461efc60872da1eca5bf45c';
    protected $apiPath = 'cards';

    /**
     * @test
     */
    public function shouldShowCard()
    {
        $expectedArray = array('id' => $this->fakeCardId);

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeCardId)
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->show($this->fakeCardId));
    }

    /**
     * @test
     */
    public function shouldCreateCard()
    {
        $expectedArray = array(
            'name' => 'Test Card',
            'idList' => $this->fakeId('list')
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
    public function shouldNotCreateCardWithoutName()
    {
        $data = array(
            'idList' => $this->fakeId('list'),
            'desc'   => 'Test Card Description'
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
    public function shouldNotCreateCardWithoutListId()
    {
        $data = array(
            'name'   => 'Test Card',
            'desc'   => 'Test Card Description'
        );

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->create($data);
    }

    /**
     * @test
     */
    public function shouldUpdateCard()
    {
        $expectedArray = array('name' => 'Test Card');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId)
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->update($this->fakeCardId, $expectedArray));
    }

    /**
     * @test
     */
    public function shouldGetField()
    {
        $field = 'desc';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/desc')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getField($this->fakeCardId, $field));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotGetUnexistingField()
    {
        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('get');

        $api->getField($this->fakeCardId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldSetName()
    {
        $name = 'Test Board';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/name')
            ->will($this->returnValue($name));

        $this->assertEquals($name, $api->setName($this->fakeCardId, $name));
    }

    /**
     * @test
     */
    public function shouldSetDescription()
    {
        $description = 'Test Card Description';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/desc')
            ->will($this->returnValue($description));

        $this->assertEquals($description, $api->setDescription($this->fakeCardId, $description));
    }

    /**
     * @test
     */
    public function shouldSetClosed()
    {
        $closed = true;

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/closed')
            ->will($this->returnValue($closed));

        $this->assertEquals($closed, $api->setClosed($this->fakeCardId, $closed));
    }

    /**
     * @test
     */
    public function shouldSetSubscribed()
    {
        $subscribed = true;

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/subscribed')
            ->will($this->returnValue($subscribed));

        $this->assertEquals($subscribed, $api->setSubscribed($this->fakeCardId, $subscribed));
    }

    /**
     * @test
     */
    public function shouldSetPosition()
    {
        $position = true;

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/pos')
            ->will($this->returnValue($position));

        $this->assertEquals($position, $api->setPosition($this->fakeCardId, $position));
    }

    /**
     * @test
     */
    public function shouldSetDueDate()
    {
        $date = new \DateTime('tomorrow');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/due')
            ->will($this->returnValue($date));

        $this->assertEquals($date, $api->setDueDate($this->fakeCardId, $date));
    }

    /**
     * @test
     */
    public function shouldSetList()
    {
        $lisId = $this->fakeId('list');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/idList')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->setList($this->fakeCardId, $lisId));
    }

    /**
     * @test
     */
    public function shouldGetList()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/list')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getList($this->fakeCardId));
    }

    /**
     * @test
     */
    public function shouldGetListField()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/list/name')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getListField($this->fakeCardId, 'name'));
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

        $api->getListField($this->fakeCardId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldSetBoard()
    {
        $lisId = $this->fakeId('list');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/idBoard')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->setBoard($this->fakeCardId, $lisId));
    }

    /**
     * @test
     */
    public function shouldGetBoard()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/board')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getBoard($this->fakeCardId));
    }

    /**
     * @test
     */
    public function shouldGetBoardField()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/board/name')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getBoardField($this->fakeCardId, 'name'));
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

        $api->getBoardField($this->fakeCardId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetActionsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Card\Actions', $api->actions());
    }

    /**
     * @test
     */
    public function shouldGetAttachmentsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Card\Attachments', $api->attachments());
    }

    /**
     * @test
     */
    public function shouldGetChecklistsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Card\Checklists', $api->checklists());
    }

    /**
     * @test
     */
    public function shouldGetLabelsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Card\Labels', $api->labels());
    }

    /**
     * @test
     */
    public function shouldGetMembersApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Card\Members', $api->members());
    }

    /**
     * @test
     */
    public function shouldGetStickersApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Card\Stickers', $api->stickers());
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Card';
    }
}
