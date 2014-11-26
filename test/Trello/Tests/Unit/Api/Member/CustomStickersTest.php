<?php

namespace Trello\Tests\Unit\Api\Member;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class CustomStickersTest extends TestCase
{
    protected $apiPath = 'members/#id#/customStickers';

    /**
     * @test
     */
    public function notImplementedYet()
    {
        $this->markTestSkipped(
            sprintf('The "%s" API is not implemented yet.', $this->getApiClass())
        );
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Member\CustomStickers';
    }
}
