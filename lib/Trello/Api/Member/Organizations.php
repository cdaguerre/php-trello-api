<?php

namespace Trello\Api\Member;

use Trello\Api\AbstractApi;
use Trello\Api\Organization;
use Trello\Exception\InvalidArgumentException;

/**
 * Trello Member Organizations API
 * @link https://trello.com/docs/api/member
 *
 * Fully implemented.
 */
class Organizations extends AbstractApi
{
    protected $path = 'members/#id#/organizations';

    /**
     * Get organizations related to a given member
     * @link https://trello.com/docs/api/member/#get-1-members-idmember-or-username-organizations
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
     * Filter organizations related to a given member
     * @link https://trello.com/docs/api/member/#get-1-members-idmember-or-username-organizations-filter
     *
     * @param string       $id     the organization's id
     * @param string|array $filter array of / one of 'all', 'none', 'members', 'public'
     *
     * @return array
     */
    public function filter($id, $filter = 'all')
    {
        $allowed = array('all', 'none', 'members', 'public');
        $filters = $this->validateAllowedParameters($allowed, $filter, 'filter');

        return $this->get($this->getPath($id).'/'.implode(',', $filters));
    }

    /**
     * Get organizations a given member is invited to
     * @link https://trello.com/docs/api/member/#get-1-members-idmember-or-username-organizationsinvited
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
     * Get a field of an organization a given member is invited to
     * @link https://trello.com/docs/api/member/#get-1-members-idmember-or-username-organizationsinvited-field
     *
     * @param string $id     the member's id or username
     *
     * @return array
     */
    public function invitedToField($id, $field)
    {
        $this->validateAllowedParameters(Organization::$fields, $field, 'field');

        return $this->get($this->getPath($id).'Invited/'.rawurlencode($field));
    }
}
