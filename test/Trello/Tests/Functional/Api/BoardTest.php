<?php

namespace Trello\Tests\Functional\Api;

use Trello\Api\Board;

/**
 * @group functional
 */
class BoardTest extends TestCase
{
    protected $boardId = '5461efc60872da1eca5bf45c';

    /**
     * @test
     */
    public function shouldShowBoard()
    {
        $board = $this->client->api('board')->show($this->boardId, array('fields' => 'all'));

        $this->fieldsExist(Board::$fields, $board);
    }

    /**
     * @test
     */
    // public function shouldUpdateBoard()
    // {
    //     $boardName = 'Trello-Github';
    //     $boardNameTest = $boardName + ' test ' + time();

    //     $board = $this->client->api('board')->show($this->boardId);

    //     $board['name'] = $boardNameTest;

    //     $this->client->api('board')->update($this->boardId, $board);
    //     // $this->assertEquals($board['name'], $boardNameTest);


    //     $board = $this->client->api('board')->show($this->boardId);
    //     var_dump($board['name'] === $boardName);
    //     // $this->assertEquals($board['name'], $boardNameTest);

    //     $board['name'] = $boardName;

    //     $this->client->api('board')->update($this->boardId, $board);
    //     // $this->assertEquals($board['name'], $boardName);
    // }
}
