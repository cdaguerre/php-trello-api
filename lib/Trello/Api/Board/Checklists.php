<?php

namespace Trello\Api\Board;

use Trello\Api\AbstractApi;

/**
 * Trello Board Checklists API
 * @link https://trello.com/docs/api/board
 *
 * Fully implemented.
 */
class Checklists extends AbstractApi
{
    /**
     * Base path of board checklists api
     * @var string
     */
    protected $path = 'boards/#id#/checklists';

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
     * Add an checklist to a given board
     * @link https://trello.com/docs/api/board/#post-1-boards-board-id-checklists
     *
     * @param string $id     the board's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function create($id, array $params)
    {
        $this->validateRequiredParameters(array('name'), $params);

        return $this->post($this->getPath($id), $params);
    }
}
