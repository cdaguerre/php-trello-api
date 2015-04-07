<?php

namespace Trello\Api\Board;

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
    protected $path = 'boards/#id#/members';

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
     * Remove a given member from a given board
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-members
     *
     * @param string $id       the board's id
     * @param string $memberId the member's id
     *
     * @return array
     */
    public function remove($id, $memberId)
    {
        return $this->delete($this->getPath($id).'/'.$memberId);
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

    /**
     * Get a member's cards related to a given board
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-members-filter
     *
     * @param string $id       the board's id
     * @param string $memberId the member's id
     * @param array  $params   optional parameters
     *
     * @return array
     */
    public function cards($id, $memberId, array $params = array())
    {
        return $this->get($this->getPath($id).'/'.rawurlencode($memberId).'/cards', $params);
    }

    /**
     * Add member to a given board
     * @link https://trello.com/docs/api/board/#put-1-boards-board-id-members
     *
     * @param string $id       the board's id
     * @param string $email    the member's email address
     * @param string $fullName the member's full name
     * @param string $role     one of 'normal', 'observer' or 'admin'
     *
     * @return array
     */
    public function invite($id, $email, $fullName, $role = 'normal')
    {
        $roles = array('normal', 'observer', 'admin');

        if (!in_array($role, $roles)) {
            throw new InvalidArgumentException(sprintf(
                'The "role" parameter must be one of "%s".',
                implode(", ", $roles)
            ));
        }

        $params = array(
            'email'    => $email,
            'fullName' => $fullName,
            'type'     => $role,
        );

        return $this->put($this->getPath($id), $params);
    }

    /**
     * Get members invited to a given board
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-membersinvited
     *
     * @param string $id     the board's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getInvitedMembers($id, array $params = array())
    {
        return $this->get($this->getPath($id).'Invited', $params);
    }

    /**
     * Get a field related to a member invited to a given board
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-membersinvited-field
     *
     * @param string $id    the board's id
     * @param string $field the member's field name
     *
     * @return array
     */
    public function getInvitedMembersField($id, $field)
    {
        $this->validateAllowedParameters(Member::$fields, $field, 'field');

        return $this->get($this->getPath($id).'Invited/'.rawurlencode($field));
    }

    /**
     * Set the role of a user or an organization on a given board
     * @link https://trello.com/docs/api/board/index.html#put-1-boards-board-id-members-idmember
     *
     * @param string $id                   the board's id
     * @param string $memberOrOrganization the member's id, user name or an organization name
     *
     * @return array
     */
    public function setRole($id, $memberOrOrganization, $role)
    {
        $roles = array('normal', 'observer', 'admin');

        if (!in_array($role, $roles)) {
            throw new InvalidArgumentException(sprintf(
                'The "role" parameter must be one of "%s".',
                implode(", ", $roles)
            ));
        }

        $params = array(
            'idMember' => $memberOrOrganization,
            'type' => $role,
        );

        return $this->post($this->getPath($id).'/'.rawurlencode($memberOrOrganization), $params);
    }
}
