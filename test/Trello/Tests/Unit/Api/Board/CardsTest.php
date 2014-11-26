<?php

namespace Trello\Tests\Unit\Api\Board;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class CardsTest extends TestCase
{
    protected $apiPath = 'boards/#id#/cards';

    /**
     * @test
     */
    public function shouldGetAllCards()
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
    public function shouldFilterCardsWithDefaultFilter()
    {
        $defaultFilter = 'all';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/'.$defaultFilter)
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->filter($this->fakeParentId));
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
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->filter($this->fakeParentId, $filter));
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
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->filter($this->fakeParentId, $filter));
    }

    /**
     * @test
     */
    public function shouldShowCard()
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
        return 'Trello\Api\Board\Cards';
    }
}
