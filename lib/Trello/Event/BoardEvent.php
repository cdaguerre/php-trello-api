<?php

namespace Trello\Event;

use Trello\Model\BoardInterface;

class BoardEvent extends AbstractEvent
{
    /**
     * @var BoardInterface
     */
    protected $board;

    /**
     * Set board
     *
     * @param BoardInterface $board
     */
    public function setBoard(BoardInterface $board)
    {
        $this->board = $board;
    }

    /**
     * Get board
     *
     * @return BoardInterface
     */
    public function getBoard()
    {
        return $this->board;
    }
}
