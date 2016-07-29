<?php

namespace Trello\Api\Organization;

use Trello\Api\AbstractApi;

/**
 * Trello Organization Boards API
 * @link https://trello.com/docs/api/organization
 *
 * Fully implemented.
 */
class Boards extends AbstractApi
{
    protected $path = 'organization/#id#/boards';

    /**
     * Get boads related to a given organization
     * @link https://trello.com/docs/api/organization/#get-1-organizations-idorg-or-name-boards
     *
     * @param string $id     the organization's id or username
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function all($id, array $params = array())
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Filter boards related to a given organization
     * @link https://trello.com/docs/api/organization/#get-1-organizations-idorg-or-name-boards-filter
     *
     * @param string       $id     the board's id
     * @param string|array $filter array of / one of 'all', none', 'open', 'closed', 'all'
     *
     * @return array
     */
    public function filter($id, $filter = 'all')
    {
        $allowed = array('all', 'members', 'organization', 'public', 'open', 'closed', 'pinned', 'unpinned', 'starred');
        $filters = $this->validateAllowedParameters($allowed, $filter, 'filter');

        return $this->get($this->getPath($id).'/'.implode(',', $filters));
    }
}
