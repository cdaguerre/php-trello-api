<?php

namespace Trello\Tests\Unit\Api;

/**
 * @group unit
 */
class CardlistTest extends TestCase
{
    protected $fakeListId = '5461efc60872da1eca5bf45c';
    protected $apiPath = 'lists';

    /**
     * @test
     */
    public function shouldShowList()
    {
        $expectedArray = array('id' => $this->fakeListId);

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('lists/'.$this->fakeListId)
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->show($this->fakeListId));
    }

    /**
     * @test
     */
    public function shouldCreateList()
    {
        $expectedArray = array(
            'name' => 'Test List',
            'idBoard' => $this->fakeId('board'),
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
    public function shouldNotCreateListWithoutName()
    {
        $data = array(
            'idBoard' => $this->fakeId('board'),
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
    public function shouldNotCreateListWithoutBoardId()
    {
        $data = array(
            'name'   => 'Test List',
        );

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->create($data);
    }

    /**
     * @test
     */
    public function shouldUpdateList()
    {
        $expectedArray = array('name' => 'Test List');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeListId)
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->update($this->fakeListId, $expectedArray));
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
            ->with($this->apiPath.'/'.$this->fakeId.'/idBoard')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->setBoard($this->fakeId, $lisId));
    }

    /**
     * @test
     */
    public function shouldGetBoard()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeListId.'/board')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getBoard($this->fakeListId));
    }

    /**
     * @test
     */
    public function shouldGetBoardField()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeListId.'/board/name')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getBoardField($this->fakeListId, 'name'));
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

        $api->getBoardField($this->fakeListId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldSetName()
    {
        $name = 'Test Checklist';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeListId.'/name')
            ->will($this->returnValue($name));

        $this->assertEquals($name, $api->setName($this->fakeListId, $name));
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
            ->with($this->apiPath.'/'.$this->fakeListId.'/pos')
            ->will($this->returnValue($position));

        $this->assertEquals($position, $api->setPosition($this->fakeListId, $position));
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
            ->with($this->apiPath.'/'.$this->fakeListId.'/closed')
            ->will($this->returnValue($closed));

        $this->assertEquals($closed, $api->setClosed($this->fakeListId, $closed));
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
            ->with($this->apiPath.'/'.$this->fakeListId.'/subscribed')
            ->will($this->returnValue($subscribed));

        $this->assertEquals($subscribed, $api->setSubscribed($this->fakeListId, $subscribed));
    }

    /**
     * @test
     */
    public function shouldGetActionsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Cardlist\Actions', $api->actions());
    }

    /**
     * @test
     */
    public function shouldGetCardsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Cardlist\Cards', $api->cards());
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Cardlist';
    }
}
