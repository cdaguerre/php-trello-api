<?php

namespace Trello\Tests\Unit\Api\Board;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class MembersTest extends TestCase
{
    protected $apiPath = 'boards/#id#/members';

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
    public function shouldRemoveMember()
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
    public function shouldInviteMember()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->getPath())
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->invite($this->fakeParentId, 'john@doe.com', 'John Doe', 'normal'));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotInviteMemberWithUnexistingRole()
    {
        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('put');

        $api->invite($this->fakeParentId, 'john@doe.com', 'John Doe', 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetMemberCards()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/'.$this->fakeId.'/cards')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->cards($this->fakeParentId, $this->fakeId));
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

    /**
     * @test
     */
    public function shouldGetInvitedMembers()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'Invited')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getInvitedMembers($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetInvitedMembersField()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'Invited/bio')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getInvitedMembersField($this->fakeParentId, 'bio'));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotGetUnexistingInvitedMembersField()
    {
        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('get');

        $api->getInvitedMembersField($this->fakeParentId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldSetRole()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath().'/'.$this->fakeId)
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->setRole($this->fakeParentId, $this->fakeId, 'normal'));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotSetUnexistingRole()
    {
        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->setRole($this->fakeParentId, $this->fakeId, 'unexisting');
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Board\Members';
    }
}
