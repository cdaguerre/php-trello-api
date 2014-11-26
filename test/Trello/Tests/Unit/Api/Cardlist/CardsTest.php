<?php

namespace Trello\Tests\Unit\Api\Cardlist;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class CardsTest extends TestCase
{
    protected $apiPath = 'lists/#id#/cards';

    /**
     * @test
     */
    public function shouldGetAllCards()
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
    public function shouldFilterCardsWithDefaultFilter()
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
    public function shouldFilterCardsWithStringArgument()
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
    public function shouldFilterCardsWithArrayArgument()
    {
        $filter = array('open','closed');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/open,closed')
            ->will($this->returnValue($this->fakeId));

        $this->assertEquals($this->fakeId, $api->filter($this->fakeParentId, $filter));
    }

    /**
     * @test
     */
    public function shouldCreateCard()
    {
        $name = 'Test card';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->will($this->returnValue($name));

        $this->assertEquals($name, $api->create($this->fakeParentId, $name));
    }

    /**
     * @test
     */
    public function shouldArchiveAllCards()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('lists/'.$this->fakeId.'/archiveAllCards')
            ->will($this->returnValue($this->fakeId));

        $this->assertEquals($this->fakeId, $api->archiveAll($this->fakeId));
    }

    /**
     * @test
     */
    public function shouldMoveAllCards()
    {
        $destId = $this->fakeId('destList');
        $boardId = $this->fakeId('board');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('lists/'.$this->fakeId.'/moveAllCards')
            ->will($this->returnValue($destId));

        $this->assertEquals($destId, $api->moveAll($this->fakeId, $boardId, $destId));
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Cardlist\Cards';
    }
}
