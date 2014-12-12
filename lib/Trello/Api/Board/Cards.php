<?php

namespace Trello\Api\Board;

use Trello\Api\AbstractApi;

/**
 * Trello Board Cards API
 * @link https://trello.com/docs/api/board
 *
 * Fully implemented.
 */
class Cards extends AbstractApi
{
    /**
     * Base path of board cards api
     * @var string
     */
    protected $path = 'boards/#id#/cards';

    /**
     * Get cards related to a given board
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-cards
     *
     * @param string $id     the board's
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function all($id, array $params = array())
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Filter cards related to a given board
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-cards-filter
     *
     * @param string       $id     the board's id
     * @param string|array $filter array of / one of 'all', 'visible', 'none', 'open', 'closed'
     *
     * @return array
     */
    public function filter($id, $filter = 'all')
    {
        $allowed = array('all', 'visible', 'none', 'open', 'closed');
        $filter = $this->validateAllowedParameters($allowed, $filter, 'filter');

        return $this->get($this->getPath($id).'/'.implode(',', $filter));
    }

    /**
     * Get a card related to a given board
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-cards-idcard
     *
     * @param string $id     the board's id
     * @param string $cardId the card's id
     *
     * @return array
     */
    public function show($id, $cardId)
    {
        return $this->get($this->getPath($id).'/'.rawurlencode($cardId));
    }
}
