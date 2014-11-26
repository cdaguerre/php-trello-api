<?php

namespace Trello\Tests\Unit\Api\Checklist;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class ItemsTest extends TestCase
{
    protected $apiPath = 'checklists/#id#/checkItems';

    /**
     * @test
     */
    public function shouldGetAllItems()
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
    public function shouldCreateItem()
    {
        $name = 'Test Item';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->will($this->returnValue($name));

        $this->assertEquals($name, $api->create($this->fakeParentId, $name, true));
    }

    /**
     * @test
     */
    public function shouldRemoveItem()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId)
            ->will($this->returnValue($this->fakeId));

        $this->assertEquals($this->fakeId, $api->remove($this->fakeParentId, $this->fakeId));
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Checklist\Items';
    }
}
