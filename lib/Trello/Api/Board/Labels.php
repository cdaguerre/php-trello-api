<?php

namespace Trello\Api\Board;

use Trello\Api\AbstractApi;
use Trello\Exception\InvalidArgumentException;

/**
 * Trello Board Labels API
 * @link https://trello.com/docs/api/board
 *
 * Fully implemented.
 */
class Labels extends AbstractApi
{
    /**
     * Base path of board labels api
     * @var string
     */
    protected $path = 'boards/#id#/labels';

    /**
     * Get labels related to a given board
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-labels
     *
     * @param string $id     the board's
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function all($id, array $params = array())
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Get a label related to a given board
     * @link https://trello.com/docs/api/board/#get-1-boards-board-id-labels-idlabel
     *
     * @param string $id    the board's id
     * @param string $color the label's color
     *
     * @return array
     */
    public function show($id, $color)
    {
        $colors = array('blue', 'green', 'orange', 'purple', 'red', 'yellow');

        if (!in_array($color, $colors)) {
            throw new InvalidArgumentException(sprintf(
                'The "color" parameter must be one of "%s".',
                implode(", ", $colors)
            ));
        }

        return $this->get($this->getPath($id).'/'.rawurlencode($color));
    }

    /**
     * Set a label's name on a given board and for a given color
     * @link https://trello.com/docs/api/board/#put-1-boards-board-id-labelnames-blue
     * @link https://trello.com/docs/api/board/#put-1-boards-board-id-labelnames-green
     * @link https://trello.com/docs/api/board/#put-1-boards-board-id-labelnames-orange
     * @link https://trello.com/docs/api/board/#put-1-boards-board-id-labelnames-purple
     * @link https://trello.com/docs/api/board/#put-1-boards-board-id-labelnames-red
     * @link https://trello.com/docs/api/board/#put-1-boards-board-id-labelnames-yellow
     *
     * @param string $id    the board's id
     * @param string $color the label color to set the name of
     * @param string $name
     *
     * @return array
     */
    public function setName($id, $color, $name)
    {
        $colors = array('blue', 'green', 'orange', 'purple', 'red', 'yellow');

        if (!in_array($color, $colors)) {
            throw new InvalidArgumentException(sprintf(
                'The "color" parameter must be one of "%s".',
                implode(", ", $colors)
            ));
        }

        return $this->put('boards/'.rawurlencode($id).'/labelNames/'.rawurlencode($color), array('value' => $name));
    }
}
