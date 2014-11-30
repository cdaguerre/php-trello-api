<?php

namespace Trello\Tests\Unit\Api\Member;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class BoardsTest extends TestCase
{
    protected $apiPath = 'members/#id#/boards';

    /**
     * @test
     */
    public function shouldGetAllBoards()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath())
            ->will($this->returnValue($this->fakeId));

        $this->assertEquals($this->fakeId, $api->all($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldFilterBoardsWithDefaultFilter()
    {
        $defaultFilter = 'all';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/'.$defaultFilter)
            ->will($this->returnValue($defaultFilter));

        $this->assertEquals($defaultFilter, $api->filter($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldFilterBoardsWithStringArgument()
    {
        $filter = 'open';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/open')
            ->will($this->returnValue($filter));

        $this->assertEquals($filter, $api->filter($this->fakeParentId, $filter));
    }

    /**
     * @test
     */
    public function shouldFilterBoardsWithArrayArgument()
    {
        $filter = array('open','closed');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/open,closed')
            ->will($this->returnValue($filter));

        $this->assertEquals($filter, $api->filter($this->fakeParentId, $filter));
    }

    /**
     * @test
     */
    public function shouldGetInvitedTo()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'Invited')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->invitedTo($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetInvitedToField()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'Invited/name')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->invitedToField($this->fakeParentId, 'name'));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotGetUnexistingInvitedToField()
    {
        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('get');

        $api->invitedToField($this->fakeParentId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldPinBoard()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('members/'.$this->fakeParentId.'/idBoardsPinned')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->pin($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldUnpinBoard()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with('members/'.$this->fakeParentId.'/idBoardsPinned/'.$this->fakeId)
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->unpin($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldGetBackgroundsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Member\Board\Backgrounds', $api->backgrounds());
    }

    /**
     * @test
     */
    public function shouldGetStarsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Member\Board\Stars', $api->stars());
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Member\Boards';
    }
}
