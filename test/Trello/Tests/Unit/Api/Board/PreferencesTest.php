<?php

namespace Trello\Tests\Unit\Api\Board;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class PreferencesTest extends TestCase
{
    protected $apiPath = 'boards/#id#/prefs';

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
        return 'Trello\Api\Board\Preferences';
    }
}
