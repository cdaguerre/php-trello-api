<?php

namespace Trello\Api\Member;

use Trello\Api\AbstractApi;
use Trello\Api\Board;
use Trello\Api\Member\Board\Backgrounds;
use Trello\Api\Member\Board\Stars;
use Trello\Exception\InvalidArgumentException;

/**
 * Trello Member Boards API
 * @link https://trello.com/docs/api/member
 *
 * Fully implemented.
 */
class Boards extends AbstractApi
{
    protected $path = 'members/#id#/boards';

    /**
     * Get boads related to a given member
     * @link https://trello.com/docs/api/member/#get-1-members-idmember-or-username-boards
     *
     * @param string $id     the member's id or username
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function all($id, array $params = array())
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Filter boards related to a given member
     * @link https://trello.com/docs/api/member/#get-1-members-idmember-or-username-boards-filter
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

    /**
     * Get boads a given member is invited to
     * @link https://trello.com/docs/api/member/#get-1-members-idmember-or-username-boardsinvited
     *
     * @param string $id     the member's id or username
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function invitedTo($id, array $params = array())
    {
        return $this->get($this->getPath($id).'Invited', $params);
    }

    /**
     * Get a field of a boad a given member is invited to
     * @link https://trello.com/docs/api/member/#get-1-members-idmember-or-username-boardsinvited-field
     *
     * @param string $id     the member's id or username
     *
     * @return array
     */
    public function invitedToField($id, $field)
    {
        $this->validateAllowedParameters(Board::$fields, $field, 'field');

        return $this->get($this->getPath($id).'Invited/'.rawurlencode($field));
    }

    /**
     * Pin a boad for a given member
     * @link https://trello.com/docs/api/member/#post-1-members-idmember-or-username-idboardspinned
     *
     * @param string $id      the member's id or username
     * @param string $boardId the board's id
     *
     * @return array
     */
    public function pin($id, $boardId)
    {
        return $this->post('members/'.rawurlencode($id).'/idBoardsPinned', array('value' => $boardId));
    }

    /**
     * Unpin a boad for a given member
     * @link https://trello.com/docs/api/member/#delete-1-members-idmember-or-username-idboardspinned-idboard
     *
     * @param string $id      the member's id or username
     * @param string $boardId the board's id
     *
     * @return array
     */
    public function unpin($id, $boardId)
    {
        return $this->delete('members/'.rawurlencode($id).'/idBoardsPinned/'.rawurlencode($boardId));
    }

    /**
     * Board Backgrounds API
     *
     * @return Backgrounds
     */
    public function backgrounds()
    {
        return new Backgrounds($this->client);
    }

    /**
     * Board Stars API
     *
     * @return Stars
     */
    public function stars()
    {
        return new Stars($this->client);
    }
}
