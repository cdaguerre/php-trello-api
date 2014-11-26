<?php

namespace Trello\Tests\Unit\Api\Card;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class ActionsTest extends TestCase
{
    protected $apiPath = 'cards/#id#/actions';

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

    /**
     * @test
     */
    public function shouldAddComment()
    {
        $text = 'Comment text';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath().'/comments')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->addComment($this->fakeParentId, $text));
    }

    /**
     * @test
     */
    public function shouldRemoveComment()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/comments/'.$this->fakeId)
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->removeComment($this->fakeParentId, $this->fakeId));
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Card\Actions';
    }
}
