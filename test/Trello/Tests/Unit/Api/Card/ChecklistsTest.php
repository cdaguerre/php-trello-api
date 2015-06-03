<?php

namespace Trello\Tests\Unit\Api\Card;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class ChecklistsTest extends TestCase
{
    protected $apiPath = 'cards/#id#/checklists';

    /**
     * @test
     */
    public function shouldGetAllChecklists()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('cards/'.$this->fakeParentId.'/checklists')
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

    /**
     * @test
     */
    public function shouldUpdateItem()
    {
        $item = array('name' => 'Test', 'state' => true);

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->getPath().'/'.$this->fakeId('checklist').'/checkItem/'.$this->fakeId)
            ->will($this->returnValue($item));

        $this->assertEquals($item, $api->updateItem($this->fakeParentId, $this->fakeId('checklist'), $this->fakeId, $item));
    }

    /**
     * @test
     */
    public function shouldCreateItem()
    {
        $item = array('name' => 'Test', 'state' => true);

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath().'/'.$this->fakeId('checklist').'/checkItem')
            ->will($this->returnValue($item));

        $this->assertEquals($item, $api->createItem($this->fakeParentId, $this->fakeId('checklist'), $item));
    }

    /**
     * @test
     */
    public function shouldRemoveItem()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId('checklist').'/checkItem/'.$this->fakeId)
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->removeItem($this->fakeParentId, $this->fakeId('checklist'), $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldConvertItemToCard()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath().'/'.$this->fakeId('checklist').'/checkItem/'.$this->fakeId.'/convertToCard')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->convertItemToCard($this->fakeParentId, $this->fakeId('checklist'), $this->fakeId));
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Card\Checklists';
    }
}
