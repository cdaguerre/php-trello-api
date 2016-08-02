<?php

namespace Trello\Api\Organization;

use Trello\Api\AbstractApi;
use Trello\Api\Member;
use Trello\Exception\InvalidArgumentException;

/**
 * Trello Board Members API
 * @link https://trello.com/docs/api/board
 *
 * Fully implemented.
 */
class Members extends AbstractApi
{
    /**
     * Base path of board members api
     * @var string
     */
    protected $path = 'organizations/#id#/members';

    /**
     * Get a given board's members
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-members
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
     * Filter members related to a given board
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-members-filter
     *
     * @param string       $id     the board's id
     * @param string|array $filter array of / one of 'none', 'normal', 'admins', 'owners', 'all'
     *
     * @return array
     */
    public function filter($id, $filter = 'all')
    {
        $allowed = array('none', 'normal', 'admins', 'owners', 'all');
        $filters = $this->validateAllowedParameters($allowed, $filter, 'filter');

        return $this->get($this->getPath($id).'/'.implode(',', $filters));
    }
}
