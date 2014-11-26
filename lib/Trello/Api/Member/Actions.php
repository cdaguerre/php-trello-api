<?php

namespace Trello\Api\Member;

use Trello\Api\AbstractApi;

/**
 * Trello Member Actions API
 * @link https://trello.com/docs/api/member
 *
 * Fully implemented.
 */
class Actions extends AbstractApi
{
    protected $path = 'members/#id#/actions';

    /**
     * Get actions related to a given member
     * @link https://trello.com/docs/api/member/#get-1-members-idmember-or-username-actions
     *
     * @param string $id     the card's id or short link
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function all($id, array $params = array())
    {
        return $this->get($this->getPath($id), $params);
    }
}
