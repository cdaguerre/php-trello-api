<?php

namespace Trello\Tests\Unit\Api\Board;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class MyPreferencesTest extends TestCase
{
    protected $apiPath = 'boards/#id#/myPrefs';

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
        return 'Trello\Api\Board\MyPreferences';
    }
}
