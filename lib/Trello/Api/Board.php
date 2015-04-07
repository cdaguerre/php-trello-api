<?php

namespace Trello\Api;

use Trello\Exception\InvalidArgumentException;

/**
 * Trello Board API
 * @package PHP Trello API
 * @category API
 * @link https://trello.com/docs/api/board
 *
 * Not implemented:
 * - Board my preferences API @see Board\MyPreferences
 * - Board preferences API @see Board\Preferences
 * - Board power ups API @see Board\PowerUps
 * - Board memberships API @see Board\Memberships
 * - https://trello.com/docs/api/board/#post-1-boards-board-id-calendarkey-generate
 * - https://trello.com/docs/api/board/#post-1-boards-board-id-emailkey-generate
 */
class Board extends AbstractApi
{
    /**
     * Base path of boards api
     * @var string
     */
    protected $path = 'boards';

    /**
     * Board fields
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-field
     * @var array
     */
    public static $fields = array(
        'name',
        'desc',
        'descData',
        'closed',
        'idOrganization',
        'invited',
        'pinned',
        'starred',
        'url',
        'prefs',
        'invitations',
        'memberships',
        'shortLink',
        'subscribed',
        'labelNames',
        'powerUps',
        'dateLastActivity',
        'dateLastView',
        'shortUrl',
    );

    /**
     * Find a board by id
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id
     *
     * @param string $id     the board's id
     * @param array  $params optional attributes
     *
     * @return array board info
     */
    public function show($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Create a board
     * @link https://trello.com/docs/api/board/#post-1-boards
     *
     * @param array $params attributes
     *
     * @return array board info
     */
    public function create(array $params = array())
    {
        $this->validateRequiredParameters(array('name'), $params);

        return $this->post($this->getPath(), $params);
    }

    /**
     * Update a board
     * @link https://trello.com/docs/api/board/#put-1-boards
     *
     * @param string $id     the board's id
     * @param array  $params board attributes to update
     *
     * @return array
     */
    public function update($id, array $params = array())
    {
        return $this->put($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Set a given board's name
     * @link https://trello.com/docs/api/board/#put-1-boards-board-id-name
     *
     * @param string $id   the board's id
     * @param string $name the name
     *
     * @return array
     */
    public function setName($id, $name)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/name', array('value' => $name));
    }

    /**
     * Set a given board's description
     * @link https://trello.com/docs/api/board/#put-1-boards-board-id-desc
     *
     * @param string $id          the board's id
     * @param string $description the description
     *
     * @return array
     */
    public function setDescription($id, $description)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/desc', array('value' => $description));
    }

    /**
     * Set a given board's state
     * @link https://trello.com/docs/api/board/#put-1-boards-board-id-closed
     *
     * @param string $id     the board's id
     * @param bool   $closed whether the board should be closed or not
     *
     * @return array
     */
    public function setClosed($id, $closed = true)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/closed', array('value' => $closed));
    }

    /**
     * Set a given board's subscription state
     * @link https://trello.com/docs/api/board/#put-1-boards-board-id-subscribed
     *
     * @param string $id         the board's id
     * @param bool   $subscribed whether to subscribe to the board or not
     *
     * @return array
     */
    public function setSubscribed($id, $subscribed = true)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/subscribed', array('value' => $subscribed));
    }

    /**
     * Set a given board's organization
     * @link https://trello.com/docs/api/board/#put-1-boards-board-id-organization
     *
     * @param string $id             the board's id
     * @param string $organizationId the organization's id
     *
     * @return array
     */
    public function setOrganization($id, $organizationId)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/idOrganization/'.rawurlencode($organizationId));
    }

    /**
     * Get a given board's organization
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-organization
     *
     * @param string $id     the board's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getOrganization($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/organization', $params);
    }

    /**
     * Get the field of the organization of a given board
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-organization-field
     *
     * @param string $id    the board's id
     * @param string $field the organization's field name
     *
     * @return array
     */
    public function getOrganizationField($id, $field)
    {
        $this->validateAllowedParameters(Organization::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/organization/'.rawurlencode($field));
    }

    /**
     * Get a given board's stars
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-boardstars
     *
     * @param string $id     the board's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getStars($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/boardStars', $params);
    }

    /**
     * Get a given board's deltas
     * @link https://trello.com/docs/api/board/index.html#get-1-boards-board-id-deltas
     *
     * @param string $id     the board's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getDeltas($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/deltas', $params);
    }

    /**
     * Mark a given board as viewed
     * @link https://trello.com/docs/api/board/#post-1-boards-board-id-markasviewed
     *
     * @param string $id the board's id
     *
     * @return array
     */
    public function setViewed($id)
    {
        return $this->post($this->getPath().'/'.rawurlencode($id).'/markAsViewed');
    }

    /**
     * Board Actions API
     *
     * @return Board\Actions
     */
    public function actions()
    {
        return new Board\Actions($this->client);
    }

    /**
     * Board Lists API
     *
     * @return Board\Cardlists
     */
    public function lists()
    {
        return new Board\Cardlists($this->client);
    }

    /**
     * Board Cards API
     *
     * @return Board\Cards
     */
    public function cards()
    {
        return new Board\Cards($this->client);
    }

    /**
     * Board Checklists API
     *
     * @return Board\Checklists
     */
    public function checklists()
    {
        return new Board\Checklists($this->client);
    }

    /**
     * Board Labels API
     *
     * @return Board\Labels
     */
    public function labels()
    {
        return new Board\Labels($this->client);
    }

    /**
     * Board Members API
     *
     * @return Board\Members
     */
    public function members()
    {
        return new Board\Members($this->client);
    }

    /**
     * Board Memberships API
     *
     * @return Board\Memberships
     */
    public function memberships()
    {
        return new Board\Memberships($this->client);
    }

    /**
     * Board Preferences API
     *
     * @return Board\Preferences
     */
    public function preferences()
    {
        return new Board\Preferences($this->client);
    }

    /**
     * Board MyPreferences API
     *
     * @return Board\MyPreferences
     */
    public function myPreferences()
    {
        return new Board\MyPreferences($this->client);
    }

    /**
     * Board PowerUps API
     *
     * @return Board\PowerUps
     */
    public function powerUps()
    {
        return new Board\PowerUps($this->client);
    }
}
