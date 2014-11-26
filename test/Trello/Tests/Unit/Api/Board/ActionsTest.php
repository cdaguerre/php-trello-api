<?php

namespace Trello\Tests\Unit\Api\Board;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class ActionsTest extends TestCase
{
    protected $apiPath = 'boards/#id#/actions';

    /**
     * @test
     */
    public function shouldGetAllActions()
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
        return 'Trello\Api\Board\Actions';
    }
}
