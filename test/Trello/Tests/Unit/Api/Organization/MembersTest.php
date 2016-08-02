<?php

namespace Trello\Tests\Unit\Api\Organization;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class MembersTest extends TestCase
{
    protected $apiPath = 'organization/#id#/members';

    /**
     * @test
     */
    public function shouldGetAllMembers()
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
    public function shouldFilterMembersWithDefaultFilter()
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
    public function shouldFilterMembersWithStringArgument()
    {
        $filter = 'admins';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/admins')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->filter($this->fakeParentId, $filter));
    }

    /**
     * @test
     */
    public function shouldFilterMembersWithArrayArgument()
    {
        $filter = array('admins','owners');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/admins,owners')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->filter($this->fakeParentId, $filter));
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Organization\Members';
    }
}
