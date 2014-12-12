<?php

namespace Trello\Api\Board;

use Trello\Api\AbstractApi;

/**
 * Trello Board Lists API
 * @link https://trello.com/docs/api/board
 *
 * Fully implemented.
 */
class Cardlists extends AbstractApi
{
    /**
     * Base path of board lists api
     * @var string
     */
    protected $path = 'boards/#id#/lists';

    /**
     * Get a given board's lists
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-lists
     *
     * @param string $id     the board's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function all($id, array $params = array())
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Filter card lists related to a given board
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-lists-filter
     *
     * @param string       $id     the board's id
     * @param string|array $filter array of / one of 'all', 'none', 'open', 'closed'
     *
     * @return array
     */
    public function filter($id, $filter = 'all')
    {
        $allowed = array('all', 'none', 'open', 'closed');
        $filter = $this->validateAllowedParameters($allowed, $filter, 'filter');

        return $this->get($this->getPath($id).'/'.implode(',', $filter));
    }

    /**
     * Create a list on a given board
     * @link https://trello.com/docs/api/board/#post-1-boards-board-id-lists
     *
     * @param array $params
     *
     * @return array
     */
    public function create($id, array $params = array())
    {
        $this->validateRequiredParameters(array('name'), $params);

        return $this->post($this->getPath($id), $params);
    }
}
