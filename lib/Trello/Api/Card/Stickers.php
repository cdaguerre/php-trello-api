<?php

namespace Trello\Api\Card;

use Trello\Api\AbstractApi;

/**
 * Trello Card Stickers API
 * @link https://trello.com/docs/api/card
 *
 * Fully implemented.
 */
class Stickers extends AbstractApi
{
    protected $path = 'cards/#id#/stickers';

    /**
     * Get stickers related to a given card
     * @link https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-stickers
     *
     * @param string $id     the card's id or short link
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function all($id, array $params = array())
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Get a given sticker on a given card
     * @link https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-stickers-idsticker
     *
     * @param string       $id        the card's id or short link
     * @param string       $stickerId the sticker's id
     * @param string|array $fields    'all' or a array of:
     *                                - image
     *                                - imageScaled
     *                                - imageUrl
     *                                - left
     *                                - rotate
     *                                - top
     *                                - zIndex
     *                                Defaults to 'all'
     *
     * @return array
     */
    public function show($id, $stickerId, $fields = 'all')
    {
        $allowed = array('all', 'image', 'imageScaled', 'imageUrl', 'left', 'rotate', 'top', 'zIndex');
        $fields = $this->validateAllowedParameters($allowed, $fields, 'field');

        return $this->get($this->getPath($id).'/'.rawurlencode($stickerId), $fields);
    }

    /**
     * Update a given sticker on a given card
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-stickers-idsticker
     *
     * @param string $id        the card's id or short link
     * @param string $stickerId the sticker's id
     * @param array  $params    Parameters to update (all optional but at least one of them is required):
     *                          - left
     *                          - rotate
     *                          - top
     *                          - zIndex
     *
     * @return array
     */
    public function update($id, $stickerId, array $params)
    {
        $oneOf = array('left', 'rotate', 'top', 'zIndex');
        $this->validateAtLeastOneOf($oneOf, $params);

        return $this->put($this->getPath($id).'/'.rawurlencode($stickerId), $params);
    }

    /**
     * Create a given sticker on a given card
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-stickers-idsticker
     *
     * @param  string $id     the card's id or short link
     * @param  array  $params Properties of the sticker
     *                        - image (string)
     *                        - top
     *                        - left
     *                        - zIndex
     *                        - rotate (optional, default 0)
     * @return array
     */
    public function create($id, array $params)
    {
        $required = array('image', 'left', 'top', 'zIndex');
        $this->validateRequiredParameters($required, $params);

        return $this->post($this->getPath($id), $params);
    }

    /**
     * Remove a given sticker from a given card
     * @link https://trello.com/docs/api/card/#delete-1-cards-card-id-or-shortlink-stickers-idsticker
     *
     * @param string $id        the card's id or short link
     * @param string $stickerId the sticker's id
     *
     * @return array
     */
    public function remove($id, $stickerId)
    {
        return $this->delete($this->getPath($id).'/'.rawurlencode($stickerId));
    }
}
