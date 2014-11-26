<?php

namespace Trello\Tests\Unit\Api\Board;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class CardlistsTest extends TestCase
{
    protected $apiPath = 'boards/#id#/lists';

    /**
     * @test
     */
    public function shouldGetAllCardlists()
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
    public function shouldFilterCardlistsWithDefaultFilter()
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
    public function shouldFilterCardlistsWithStringArgument()
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
    public function shouldFilterCardlistsWithArrayArgument()
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
    public function shouldCreateCardlist()
    {
        $data = array('name' => 'Test list');

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
    public function shouldNotCreateCardlistWithoutName()
    {
        $data = array('desc' => 'Test description');

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->create($this->fakeParentId, $data);
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Board\Cardlists';
    }
}
