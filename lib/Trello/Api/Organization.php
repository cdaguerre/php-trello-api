<?php

namespace Trello\Api;

/**
 * Trello Organization API
 * @link https://trello.com/docs/api/organization
 *
 * Not implemented.
 */
class Organization extends AbstractApi
{
    /**
     * Base path of organizations api
     * @var string
     */
    protected $path = 'organizations';

    /**
     * Organization fields
     * @link https://trello.com/docs/api/organization/#get-1-organizations-idorg-or-name-field
     * @var array
     */
    public static $fields = array(
        'name',
        'displayName',
        'desc',
        'descData',
        'idBoards',
        'invited',
        'invitations',
        'memberships',
        'prefs',
        'powerUps',
        'products',
        'billableMemberCount',
        'url',
        'website',
        'logoHash',
        'premiumFeatures'
    );

    /**
     * Find an organization by id
     * @link https://trello.com/docs/api/organization/#get-1-organizations-idorg-or-name
     *
     * @param string $id     the organization's id
     * @param array  $params optional attributes
     *
     * @return array
     */
    public function show($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Organization Boards API
     *
     * @return Organization\Boards
     */
    public function boards()
    {
        return new Organization\Boards($this->client);
    }

    /**
     * Organization Members API
     *
     * @return Organization\Members
     */
    public function members()
    {
        return new Organization\Members($this->client);
    }
}
