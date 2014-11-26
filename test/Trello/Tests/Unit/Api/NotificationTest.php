<?php

namespace Trello\Tests\Unit\Api;

/**
 * @group unit
 */
class NotificationTest extends TestCase
{
    /**
     * @test
     */
    public function shouldShowNotification()
    {
        $expectedArray = array('id' => '54744b094fef0c7d704ca379');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('notifications/54744b094fef0c7d704ca379')
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->show('54744b094fef0c7d704ca379'));
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Notification';
    }
}
