<?php

namespace Trello\Api\Card;

use Trello\Api\AbstractApi;
use Trello\Exception\InvalidArgumentException;

/**
 * Trello Card Labels API
 * @link https://trello.com/docs/api/card
 *
 * Fully implemented.
 */
class Labels extends AbstractApi
{
    protected $path = 'cards/#id#/idLabels';

    /**
     * Set a given card's labels
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-labels
     *
     * @param string $id     the card's id or short link
     * @param string $label  the label's id
     *
     * @return array card info
     *
     * @throws InvalidArgumentException If a label does not exist
     */
    public function set($id, $label)
    {
        return $this->post($this->getPath($id), array('value' => $label));
    }

    /**
     * Remove a given label from a given card
     * @link https://trello.com/docs/api/card/#delete-1-cards-card-id-or-shortlink-labels-color
     *
     * @param string $id    the card's id or short link
     * @param string $label the label's id to remove
     *
     * @return array card info
     *
     * @throws InvalidArgumentException If a label does not exist
     */
    public function remove($id, $label)
    {
        return $this->delete($this->getPath($id).'/'.rawurlencode($label));
    }
}
