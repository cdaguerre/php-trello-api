<?php

namespace Trello\Tests\Unit\Api\Board;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class PowerUpsTest extends TestCase
{
    protected $apiPath = 'boards/#id#/powerUps';

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
        return 'Trello\Api\Board\PowerUps';
    }
}
