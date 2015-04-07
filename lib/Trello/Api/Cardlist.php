<?php

namespace Trello\Api;

use Trello\Exception\InvalidArgumentException;

/**
 * Trello List API
 * @link https://trello.com/docs/api/list
 *
 * Fully implemented.
 */
class Cardlist extends AbstractApi
{
    /**
     * Base path of lists api
     * @var string
     */
    protected $path = 'lists';

    /**
     * List fields
     * @link https://trello.com/docs/api/list/#get-1-lists-list-id-or-shortlink-field
     * @var array
     */
    public static $fields = array(
        'name',
        'closed',
        'idBoard',
        'pos',
        'subscribed',
    );

    /**
     * Find a list by id
     * @link https://trello.com/docs/api/list/#get-1-lists-idlist
     *
     * @param string $id     the list's id
     * @param array  $params optional attributes
     *
     * @return array list info
     */
    public function show($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Create a list
     * @link https://trello.com/docs/api/list/#post-1-lists
     *
     * @param array $params Required attributes: 'name', 'idBoard'
     *                      Optional attributes: 'pos'
     *
     * @return array
     */
    public function create(array $params = array())
    {
        $this->validateRequiredParameters(array('name', 'idBoard'), $params);

        return $this->post($this->getPath(), $params);
    }

    /**
     * Update a list
     * @link https://trello.com/docs/api/list/#put-1-lists-idlist
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
     * Set a given list's board
     * @link https://trello.com/docs/api/list/#put-1-lists-idlist-idboard
     *
     * @param string $id      the list's id
     * @param string $boardId the board's id
     *
     * @return array board info
     */
    public function setBoard($id, $boardId)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/idBoard', array('value' => $boardId));
    }

    /**
     * Get a given list's board
     * @link https://trello.com/docs/api/list/#get-1-lists-idlist-board
     *
     * @param string $id     the list's id
     * @param array  $params optional parameters
     *
     * @return array board info
     */
    public function getBoard($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/board', $params);
    }

    /**
     * Get the field of a board of a given list
     * @link https://trello.com/docs/api/list/#get-1-lists-idlist-board-field
     *
     * @param string $id    the list's id
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
     * Set a given list's name
     * @link https://trello.com/docs/api/list/#put-1-lists-idlist-name
     *
     * @param string $id   the list's id
     * @param string $name the name
     *
     * @return array list info
     */
    public function setName($id, $name)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/name', array('value' => $name));
    }

    /**
     * Set a given list's description
     * @link https://trello.com/docs/api/list/#put-1-lists-list-id-desc
     *
     * @param string $id         the list's id
     * @param bool   $subscribed subscription state
     *
     * @return array list info
     */
    public function setSubscribed($id, $subscribed)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/subscribed', array('value' => $subscribed));
    }

    /**
     * Set a given list's state
     * @link https://trello.com/docs/api/list/#put-1-lists-idlist-closed
     *
     * @param string $id     the list's id
     * @param bool   $closed whether the list should be closed or not
     *
     * @return array list info
     */
    public function setClosed($id, $closed = true)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/closed', array('value' => $closed));
    }

    /**
     * Set a given list's position
     * @link https://trello.com/docs/api/list/#put-1-lists-idlist-pos
     *
     * @param string         $id       the list's id
     * @param string|integer $position the position, eg. 'top', 'bottom'
     *                                 or a positive number
     *
     * @return array list info
     */
    public function setPosition($id, $position)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/pos', array('value' => $position));
    }

    /**
     * Actions API
     *
     * @return Cardlist\Actions
     */
    public function actions()
    {
        return new Cardlist\Actions($this->client);
    }

    /**
     * Cards API
     *
     * @return Cardlist\Cards
     */
    public function cards()
    {
        return new Cardlist\Cards($this->client);
    }
}
