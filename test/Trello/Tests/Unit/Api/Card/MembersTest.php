<?php

namespace Trello\Tests\Unit\Api\Card;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class MembersTest extends TestCase
{
    protected $apiPath = 'cards/#id#/members';

    /**
     * @test
     */
    public function shouldGetAllMembers()
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
    public function shouldSetMembers()
    {
        $data = array(
            $this->fakeId('member1'),
            $this->fakeId('member2'),
            $this->fakeId('member3')
        );

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->getPath())
            ->will($this->returnValue($data));

        $this->assertEquals($data, $api->set($this->fakeParentId, $data));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotSetMembersWithEmptyArray()
    {
        $data = array();

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('put');

        $api->set($this->fakeParentId, $data);
    }

    /**
     * @test
     */
    public function shouldAddMember()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->will($this->returnValue($this->fakeId));

        $this->assertEquals($this->fakeId, $api->add($this->fakeParentId, $this->fakeId));
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
            ->will($this->returnValue($this->fakeId));

        $this->assertEquals($this->fakeId, $api->remove($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldAddVote()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath().'/membersVoted')
            ->will($this->returnValue($this->fakeId));

        $this->assertEquals($this->fakeId, $api->addVote($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldRemoveVote()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/membersVoted/'.$this->fakeId)
            ->will($this->returnValue($this->fakeId));

        $this->assertEquals($this->fakeId, $api->removeVote($this->fakeParentId, $this->fakeId));
    }


    protected function getApiClass()
    {
        return 'Trello\Api\Card\Members';
    }
}
