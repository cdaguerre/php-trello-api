<?php

namespace Trello\Api\Cardlist;

use Trello\Api\AbstractApi;

/**
 * Trello List Cards API
 * @link https://trello.com/docs/api/list
 *
 * Fully implemented.
 */
class Cards extends AbstractApi
{
    protected $path = 'lists/#id#/cards';

    /**
     * Get cards related to a given list
     * @link https://trello.com/docs/api/list/#get-1-lists-idlist-cards
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
     * Filter cards related to a given list
     * @link https://trello.com/docs/api/list/#get-1-lists-idlist-cards-filter
     *
     * @param string $id     the list's id
     * @param array  $filter one of 'none', 'open', 'closed', 'all'
     *
     * @return array
     */
    public function filter($id, $filter = 'all')
    {
        $allowed = array('none', 'open', 'closed', 'all');
        $filters = $this->validateAllowedParameters($allowed, $filter, 'filter');

        return $this->get($this->getPath($id).'/'.implode(',', $filters));
    }

    /**
     * Create a card
     * @link https://trello.com/docs/api/list/#post-1-lists-idlist-cards
     *
     * @param array  $params optional attributes
     *
     * @return array card info
     */
    public function create($id, $name, array $params = array())
    {
        $params['idList'] = $id;
        $params['name'] = $name;

        if (!array_key_exists('due', $params)) {
            $params['due'] = null;
        }

        return $this->post($this->getPath($id), $params);
    }

    /**
     * Archive all cards of a given list
     * @link https://trello.com/docs/api/list/#post-1-lists-idlist-archiveallcards
     *
     * @param string $id the list's id
     *
     * @return array
     */
    public function archiveAll($id)
    {
        return $this->post('lists/'.rawurlencode($id).'/archiveAllCards');
    }

    /**
     * Move all cards of a given list to another list
     * @link https://trello.com/docs/api/list/#post-1-lists-idlist-moveallcards
     *
     * @param string $id         Id of the list to move
     * @param string $boardId    id of the board that the cards should be moved to
     * @param string $destListId id of the list that the cards should be moved to
     *
     * @return array
     */
    public function moveAll($id, $boardId, $destListId)
    {
        $data = array(
            'idBoard' => $boardId,
            'idList' => $destListId,
        );

        return $this->post('lists/'.rawurlencode($id).'/moveAllCards', $data);
    }
}
