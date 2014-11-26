<?php

namespace Trello\Tests\Unit\Api\Member\Board;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class StarsTest extends TestCase
{
    protected $apiPath = 'members/#id#/boardBackgrounds';

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
        return 'Trello\Api\Member\Board\Backgrounds';
    }
}
