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
    
    protected $colors = array(
        'all',
        'green',
        'yellow',
        'orange',
        'red',
        'purple',
        'blue',
        'sky',
        'lime',
        'pink',
        'black',
        'null'
    );

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
            if (!in_array($label, $this->colors)) {
                throw new InvalidArgumentException(sprintf('Label "%s" does not exist.', $label));
            }
        }

        $labels = implode(',', $labels);

        return $this->put($this->getPath($id), array('value' => $labels));
    }
    
    /**
     * Add a label to a given card
     * @link https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-labels
     *
     * @param string $id     the card's id or short link
     * @param string $color  the label's color
     * @param string $name   the label's name (optional)
     *
     * @return array label info
     *
     * @throws InvalidArgumentException If a label does not exist
     */
    public function add($id, $color, $name = null)
    {
        if (!in_array($color, $this->colors)) {
            throw new InvalidArgumentException(sprintf('Label "%s" does not exist.', $color));
        }

        $args = array(
            'color' => $color,
            'name' => $name
        );

        return $this->post($this->getPath($id), $args);
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
        if (!in_array($label, $this->colors)) {
            throw new InvalidArgumentException(sprintf('Label "%s" does not exist.', $label));
        }

        return $this->delete($this->getPath($id).'/'.rawurlencode($label));
    }
}
