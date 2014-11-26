<?php

namespace Trello\Tests\Functional;

use Trello\Client;
use Trello\Exception\ApiLimitExceedException;
use Trello\Exception\RuntimeException;

/**
 * @group functional
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    protected $boardId;

    /**
     * Trello client
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        parent::setUp();

        $client = new Client();

        // You have to specify authentication and a board id here to run full suite

        $this->boardId = '547440ad3f8b882bc11f0497';

        $this->client = $client;
    }
}
