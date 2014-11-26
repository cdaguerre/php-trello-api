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

    protected function getApiClass()
    {
        return 'Trello\Api\Board\Members';
    }
}
