<?php

namespace Trello\Tests\Unit\Api\Board;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class ChecklistsTest extends TestCase
{
    protected $apiPath = 'boards/#id#/checklists';

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
        $data = array('name' => 'Test Checklist');

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
    public function shouldNotCreateChecklistWithoutName()
    {
        $data = array();

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->create($this->fakeParentId, $data);
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Board\Checklists';
    }
}
