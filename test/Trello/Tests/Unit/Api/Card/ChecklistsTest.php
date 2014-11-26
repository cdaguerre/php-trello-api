<?php

namespace Trello\Tests\Unit\Api\Card;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class ChecklistsTest extends TestCase
{
    protected $apiPath = 'cards/#id#/checklist';

    /**
     * @test
     */
    public function shouldGetAllChecklists()
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
    public function shouldCreateChecklist()
    {
        $data = array('name' => 'Test checklist');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->will($this->returnValue($data));

        $this->assertEquals($data, $api->create($this->fakeParentId, $data));
    }

    /**
     * @test
     * @expectedException Trello\Exception\MissingArgumentException
     */
    public function shouldNotCreateChecklistWithoutNameSourceChecklistIdOrValue()
    {
        $data = array();

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->create($this->fakeParentId, $data);
    }

    /**
     * @test
     */
    public function shouldRemoveChecklist()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId)
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->remove($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldGetItemStates()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('cards/'.$this->fakeParentId.'/checkItemStates')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->itemStates($this->fakeParentId));
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Card\Checklists';
    }
}
