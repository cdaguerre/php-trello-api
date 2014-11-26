<?php

namespace Trello\Api\Cardlist;

use Trello\Api\AbstractApi;

/**
 * Trello List Actions API
 * @link https://trello.com/docs/api/list
 *
 * Fully implemented.
 */
class Actions extends AbstractApi
{
    protected $path = 'lists/#id#/actions';

    /**
     * Get actions related to a given list
     * @link https://trello.com/docs/api/list/#get-1-lists-idlist-actions
     *
     * @param string $id     the list's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function all($id, array $params = array())
    {
        return $this->get($this->getPath($id), $params);
    }
}
