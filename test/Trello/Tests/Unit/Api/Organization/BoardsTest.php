<?php

namespace Trello\Tests\Unit\Api\Organization;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class BoardsTest extends TestCase
{
    protected $apiPath = 'organization/#id#/boards';

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

    protected function getApiClass()
    {
        return 'Trello\Api\Organization\Boards';
    }
}
