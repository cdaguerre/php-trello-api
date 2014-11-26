<?php

namespace Trello\Tests\Unit\Api\Cardlist;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class ActionsTest extends TestCase
{
    protected $apiPath = 'lists/#id#/actions';

    /**
     * @test
     */
    public function shouldGetAllActions()
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
        return 'Trello\Api\Cardlist\Actions';
    }
}
