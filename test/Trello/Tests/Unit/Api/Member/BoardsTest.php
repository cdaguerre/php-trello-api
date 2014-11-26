<?php

namespace Trello\Tests\Unit\Api\Member;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class BoardsTest extends TestCase
{
    protected $apiPath = 'members/#id#/boards';

    /**
     * @test
     */
    public function shouldGetAllBoards()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath())
            ->will($this->returnValue($this->fakeId));

        $this->assertEquals($this->fakeId, $api->all($this->fakeParentId));
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Member\Boards';
    }
}
