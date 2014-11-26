<?php

namespace Trello\Tests\Unit\Api\Checklist;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class CardsTest extends TestCase
{
    protected $apiPath = 'checklists/#id#/cards';

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

    protected function getApiClass()
    {
        return 'Trello\Api\Checklist\Cards';
    }
}
