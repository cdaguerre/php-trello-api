<?php

namespace Trello\Api\Board;

use Trello\Api\AbstractApi;

/**
 * Trello Board custom fields API
 * @link https://developers.trello.com/docs/getting-started-custom-fields
 *
 */
class CustomFields extends AbstractApi
{
    /**
     * Base path of board custom fields api
     * @var string
     */
    protected $path = 'boards/#id#/customFields';

    /**
     * Get custom fields related to a given board
     * @link https://developers.trello.com/docs/getting-started-custom-fields#section-get-custom-fields-on-a-board
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
}
