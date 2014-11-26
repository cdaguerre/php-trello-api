<?php

namespace Trello\Tests\Unit\Api\Member;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class OrganizationsTest extends TestCase
{
    protected $apiPath = 'members/#id#/organizations';

    /**
     * @test
     */
    public function shouldGetAllOrganizations()
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
    public function shouldFilterOrganizationsWithDefaultFilter()
    {
        $defaultFilter = 'all';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/'.$defaultFilter)
            ->will($this->returnValue($defaultFilter));

        $this->assertEquals($defaultFilter, $api->filter($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldFilterOrganizationsWithStringArgument()
    {
        $filter = 'members';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/members')
            ->will($this->returnValue($filter));

        $this->assertEquals($filter, $api->filter($this->fakeParentId, $filter));
    }

    /**
     * @test
     */
    public function shouldFilterOrganizationsWithArrayArgument()
    {
        $filter = array('members','public');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/members,public')
            ->will($this->returnValue($filter));

        $this->assertEquals($filter, $api->filter($this->fakeParentId, $filter));
    }

    /**
     * @test
     */
    public function shouldGetOrganizationsAMemberIsInvitedTo()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'Invited')
            ->will($this->returnValue($this->fakeParentId));

        $this->assertEquals($this->fakeParentId, $api->invitedTo($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetFieldOfAnOrganizationAMemberIsInvitedTo()
    {
        $field = 'desc';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'Invited/desc')
            ->will($this->returnValue($field));

        $this->assertEquals($field, $api->invitedToField($this->fakeParentId, $field));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotGetUnexistingFieldOfAnOrganizationAMemberIsInvitedTo()
    {
        $field = 'unexisting';

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('get');

        $api->invitedToField($this->fakeParentId, $field);
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Member\Organizations';
    }
}
