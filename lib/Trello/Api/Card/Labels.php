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
    protected $path = 'cards/#id#/labels';

    /**
     * Set a given card's labels
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-labels
     *
     * @param string $id     the card's id or short link
     * @param array  $labels the labels
     *
     * @return array card info
     *
     * @throws InvalidArgumentException If a label does not exist
     */
    public function set($id, array $labels)
    {
        foreach ($labels as $label) {
            if (!in_array($label, array('all', 'green', 'yellow', 'orange', 'red', 'purple', 'blue'))) {
                throw new InvalidArgumentException(sprintf('Label "%s" does not exist.', $label));
            }
        }

        $labels = implode(',', $labels);

        return $this->put($this->getPath($id), array('value' => $labels));
    }

    /**
     * Remove a given label from a given card
     * @link https://trello.com/docs/api/card/#delete-1-cards-card-id-or-shortlink-labels-color
     *
     * @param string $id    the card's id or short link
     * @param string $label the label to remove
     *
     * @return array card info
     *
     * @throws InvalidArgumentException If a label does not exist
     */
    public function remove($id, $label)
    {
        if (!in_array($label, array('green', 'yellow', 'orange', 'red', 'purple', 'blue'))) {
            throw new InvalidArgumentException(sprintf('Label "%s" does not exist.', $label));
        }

        return $this->delete($this->getPath($id).'/'.rawurlencode($label));
    }
}
