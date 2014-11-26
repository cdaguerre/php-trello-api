<?php

namespace Trello\Tests\Unit\Api\Member;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class CustomBackgroundsTest extends TestCase
{
    protected $apiPath = 'members/#id#/customBackgrounds';

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
        return 'Trello\Api\Member\CustomBackgrounds';
    }
}
