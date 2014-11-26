<?php

namespace Trello\Tests\Functional\Model;

use Trello\Tests\Functional\TestCase as BaseCase;
use Trello\Service;

/**
 * @group functional
 */
class TestCase extends BaseCase
{
    public function setUp()
    {
        parent::setup();

        $this->service = new Service($this->client);
    }
}
