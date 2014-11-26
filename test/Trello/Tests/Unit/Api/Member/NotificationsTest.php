<?php

namespace Trello\Tests\Unit\Api\Member;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class NotificationsTest extends TestCase
{
    protected $apiPath = 'members/#id#/notifications';

    /**
     * @test
     */
    public function shouldGetAllNotifications()
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
    public function shouldFilterNotificationsWithDefaultFilter()
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
    public function shouldFilterNotificationsWithStringArgument()
    {
        $filter = 'createCard';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/createCard')
            ->will($this->returnValue($filter));

        $this->assertEquals($filter, $api->filter($this->fakeParentId, $filter));
    }

    /**
     * @test
     */
    public function shouldFilterNotificationsWithArrayArgument()
    {
        $filter = array('createCard','updateCard');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/createCard,updateCard')
            ->will($this->returnValue($filter));

        $this->assertEquals($filter, $api->filter($this->fakeParentId, $filter));
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Member\Notifications';
    }
}
