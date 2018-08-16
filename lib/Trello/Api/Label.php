<?php

namespace Trello\Api;

use Trello\Exception\InvalidArgumentException;

class Label extends AbstractApi
{
    /**
     * Base path of labels api
     * @var string
     */
    protected $path = 'labels';


    public static $fields = array(
        'idBoard',
        'name',
        'color',
    );

    /**
     * Find a label by id
     * @link https://developers.trello.com/reference/#id
     *
     * @param string $id     the label's id
     * @param array  $params optional attributes
     *
     * @return array label info
     */
    public function show($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Create a label
     * @link https://developers.trello.com/reference/#id-1
     *
     * @param array  $params optional attributes
     *
     * @return array label info
     */
    public function create(array $params = array())
    {
        $this->validateRequiredParameters(array('name', 'idBoard', 'color'), $params);

        return $this->post('boards/'.rawurlencode($params['idBoard']).'/labels/', $params);
    }

    /**
     * Update a label
     * @link https://developers.trello.com/reference/#id-1
     *
     * @param string $id     the label's id
     * @param array  $params label attributes to update
     *
     * @return array label info
     */
    public function update($id, array $params = array())
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/labels/', $params);
    }

    /**
     * Set a given label's board
     * @link https://developers.trello.com/reference/#id-1
     *
     * @param string $id      the label's id
     * @param string $boardId the board's id
     *
     * @return array board info
     */
    public function setBoard($id, $boardId)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/idBoard', array('value' => $boardId));
    }

    /**
     * Get a given label's board
     * @link https://developers.trello.com/reference/#id
     *
     * @param string $id     the label's id
     * @param array  $params optional parameters
     *
     * @return array board info
     */
    public function getBoard($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/board', $params);
    }

    /**
     * Get the field of a board of a given label
     * @link https://developers.trello.com/reference/#id
     *
     * @param string $id    the label's id
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
}
