<?php

namespace Trello\Api;

use Trello\Exception\InvalidArgumentException;

/**
 * Trello Action API
 * @link https://trello.com/docs/api/action
 *
 * Fully implemented.
 */
class Action extends AbstractApi
{
    /**
     * Base path of actions api
     * @var string
     */
    protected $path = 'actions';

    /**
     * Action fields
     * @link https://trello.com/docs/api/action/#get-1-actions-idaction-field
     * @var array
     */
    public static $fields = array(
        'idMemberCreator',
        'data',
        'type',
        'date'
    );

    /**
     * Find an action by id
     * @link https://trello.com/docs/api/action/#get-1-actions-idaction
     *
     * @param string $id     the action's id
     * @param array  $params optional attributes
     *
     * @return array
     */
    public function show($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Update a checklist
     * @link https://trello.com/docs/api/checklist/#put-1-checklists-idchecklist
     *
     * @param string $id     the list's id
     * @param array  $params list attributes to update
     *
     * @return array list info
     */
    public function update($id, array $params = array())
    {
        return $this->put($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Remove a action
     * @link https://trello.com/docs/api/action/#delete-1-actions-idaction
     *
     * @param string $id the action's id
     *
     * @return array
     */
    public function remove($id)
    {
        return $this->delete($this->getPath().'/'.rawurlencode($id));
    }

    /**
     * Get an action's board
     * @link https://trello.com/docs/api/action/#get-1-actions-idaction-board
     *
     * @param string $id     the action's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getBoard($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/board', $params);
    }

    /**
     * Get the field of a board of a given card
     * @link https://trello.com/docs/api/action/#get-1-actions-idaction-board
     *
     * @param string $id    the action's id
     * @param array  $field the name of the field
     *
     * @return array
     *
     * @throws InvalidArgumentException if the field does not exist
     */
    public function getBoardField($id, $field)
    {
        $this->validateAllowedParameters(Board::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/board/'.rawurlencode($field));
    }

    /**
     * Get an action's list
     * @link https://trello.com/docs/api/action/#get-1-actions-idaction-list
     *
     * @param string $id     the action's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getList($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/list', $params);
    }

    /**
     * Get the field of a list of a given action
     * @link https://trello.com/docs/api/action/index.html#get-1-actions-idaction-list-field
     *
     * @param string $id    the action's id
     * @param array  $field the name of the field
     *
     * @return array
     *
     * @throws InvalidArgumentException if the field does not exist
     */
    public function getListField($id, $field)
    {
        $this->validateAllowedParameters(Cardlist::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/list/'.rawurlencode($field));
    }

    /**
     * Get an action's card
     * @link https://trello.com/docs/api/action/#get-1-actions-idaction-card
     *
     * @param string $id     the action's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getCard($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/card', $params);
    }

    /**
     * Get the field of a card of a given action
     * @link https://trello.com/docs/api/action/index.html#get-1-actions-idaction-card-field
     *
     * @param string $id    the action's id
     * @param array  $field the name of the field
     *
     * @return array
     *
     * @throws InvalidArgumentException if the field does not exist
     */
    public function getCardField($id, $field)
    {
        $this->validateAllowedParameters(Card::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/card/'.rawurlencode($field));
    }

    /**
     * Get an action's member
     * @link https://trello.com/docs/api/action/#get-1-actions-idaction-member
     *
     * @param string $id     the action's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getMember($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/member', $params);
    }

    /**
     * Get the field of a member of a given action
     * @link https://trello.com/docs/api/action/#get-1-actions-idaction-member-field
     *
     * @param string $id    the action's id
     * @param array  $field the name of the field
     *
     * @return array
     *
     * @throws InvalidArgumentException if the field does not exist
     */
    public function getMemberField($id, $field)
    {
        $this->validateAllowedParameters(Member::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/member/'.rawurlencode($field));
    }

    /**
     * Get an action's creator
     * @link https://trello.com/docs/api/action/#get-1-actions-idaction-creator
     *
     * @param string $id     the action's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getCreator($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/memberCreator', $params);
    }

    /**
     * Get the field of a creator of a given action
     * @link https://trello.com/docs/api/action/#get-1-actions-idaction-creator-field
     *
     * @param string $id    the action's id
     * @param array  $field the name of the field
     *
     * @return array
     *
     * @throws InvalidArgumentException if the field does not exist
     */
    public function getCreatorField($id, $field)
    {
        $this->validateAllowedParameters(Member::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/memberCreator/'.rawurlencode($field));
    }

    /**
     * Get an action's organization
     * @link https://trello.com/docs/api/action/#get-1-actions-idaction-organization
     *
     * @param string $id     the action's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getOrganization($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/organization', $params);
    }

    /**
     * Get the field of an organization of a given action
     * @link https://trello.com/docs/api/action/#get-1-actions-idaction-organization-field
     *
     * @param string $id    the action's id
     * @param array  $field the name of the field
     *
     * @return array
     *
     * @throws InvalidArgumentException if the field does not exist
     */
    public function getOrganizationField($id, $field)
    {
        $this->validateAllowedParameters(Organization::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/organization/'.rawurlencode($field));
    }

    /**
     * Set a given action's text
     * @link https://trello.com/docs/api/action/#put-1-actions-idaction-text
     *
     * @param string $id   the card's id or short link
     * @param string $text the text
     *
     * @return array card info
     */
    public function setText($id, $text)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/text', array('value' => $text));
    }
}
