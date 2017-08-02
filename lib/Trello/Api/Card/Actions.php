<?php

namespace Trello\Api\Card;

use Trello\Api\AbstractApi;

/**
 * Trello Card Actions API
 * @link https://trello.com/docs/api/card
 *
 * Fully implemented.
 */
class Actions extends AbstractApi
{
    protected $path = 'cards/#id#/actions';

    /**
     * Get actions related to a given card
     * @link https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-actions
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
     * Add comment to a given card
     * @link https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-actions-comments
     *
     * @param string $id   the card's id or short link
     * @param string $text comment message
     *
     * @return array
     */
    public function addComment($id, $text)
    {
        return $this->post($this->getPath($id).'/comments', array('text' => $text));
    }

    /**
     * Remove comment to a given card
     * @link https://trello.com/docs/api/card/#delete-1-cards-card-id-or-shortlink-actions-idaction-comments
     *
     * @param string $id        the card's id or short link
     * @param string $commentId the comment's id
     *
     * @return array
     */
    public function removeComment($id, $commentId)
    {
        return $this->delete($this->getPath($id).'/'.rawurlencode($commentId).'/comments');
    }
    
    /**
     * Update comment to a given card
     * @link https://trello.com/docs/api/card/index.html#put-1-cards-card-id-or-shortlink-actions-idaction-comments
     *
     * @param string $id        the card's id or short link
     * @param string $commentId the comment's id
     * @param string $text the new comment text
     * @return array
     */
    public function updateComment($id, $commentId, $text)
    {
        return $this->put($this->getPath($id).'/'.rawurlencode($commentId).'/comments', array('text' => $text));
    }
    
    /**
     * Get checkitem from a given card
     * @link https://trello.readme.io/v1.0/reference#cardsidcheckitemidcheckitem-2
     *
     * @param string $id        the card's id or short link
     * @param string $checkItemId the check item id
     * @param array $params the parameter array to retrieve, default is to retrieve all fields
     *
     * @return array
     */
    public function getCheckItem($id, $checkItemId, array $params = array('fields'=> 'all'))
    {
        return $this->get($this->getPath($id).'/checkItem/'.rawurlencode($checkItemId), $params);
    }

    /**
     * Update checkItem for  a given card
     * @link https://trello.readme.io/v1.0/reference#cardsidcheckitemidcheckitem-1
     *
     * @param string $id        the card's id or short link
     * @param string $checkItemId the check item id
     * @param array $updateFields the fields that should be updated
     * @return array
     */
    public function updateCheckItem($id, $commentId, array $updateFields = array())
    {
        return $this->put($this->getPath($id).'/'.rawurlencode($commentId).'/comments', $updateFields);
    }
    
    /**
     * Remove checkitem from a given card
     * @link https://trello.readme.io/v1.0/reference#cardsidcheckitemidcheckitem-2
     *
     * @param string $id        the card's id or short link
     * @param string $checkItemId the checklist item id
     *
     * @return array
     */
    public function removeCheckItem($id, $checkItemId)
    {
        return $this->delete($this->getPath($id).'/checkItem/'.rawurlencode($checkItemId));
    }
}
