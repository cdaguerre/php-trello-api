<?php

namespace Trello\Api\Card;

use Trello\Api\AbstractApi;
use Trello\Exception\MissingArgumentException;

/**
 * Trello Card Checklists API
 * @link https://trello.com/docs/api/card
 *
 * Fully implemented.
 */
class Checklists extends AbstractApi
{
    protected $path = 'cards/#id#/checklists';

    /**
     * Get checklists related to a given card
     * @link https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-checklists
     *
     * @param string $id     the card's id or short link
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function all($id, array $params = array())
    {
        return $this->get('cards/'.rawurlencode($id).'/checklists', $params);
    }

    /**
     * Add a checklist to a given card
     * @link https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-checklists
     *
     * @param string $id     the card's id or short link
     * @param array  $params All parameters are optional, but at least one has to be provided:
     *                       - value : id of the checklist to add, or null to create a new one.
     *                       - name : the checklist's name
     *                       - idChecklistSource : id of the source checklist to copy
     *
     * @return array
     *
     * @throws MissingArgumentException If there is not at least of the
     *                                  following parameters: 'value', 'name', 'idChecklistSource'
     */
    public function create($id, array $params)
    {
        $atLeastOneOf = array('value', 'name', 'idChecklistSource');
        $this->validateAtLeastOneOf($atLeastOneOf, $params);

        return $this->post($this->getPath($id), $params);
    }

    /**
     * Remove a given checklist from a given card
     * @link https://trello.com/docs/api/card/#delete-1-cards-card-id-or-shortlink-checklists-idchecklist
     *
     * @param string $id          the card's id or short link
     * @param string $checklistId the checklist's id
     *
     * @return array
     */
    public function remove($id, $checklistId)
    {
        return $this->delete($this->getPath($id).'/'.rawurlencode($checklistId));
    }

    /**
     * Get a given card's checklist item states
     * @link https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-checkitemstates
     *
     * @param string $id          the card's id or short link
     *
     * @return array
     */
    public function itemStates($id, array $params = array())
    {
        return $this->get('cards/'.rawurlencode($id).'/checkItemStates', $params);
    }

    /**
     * Update a given check item
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-checklist-idchecklistcurrent-checkitem-idcheckitem
     *
     * @param string $id          the card's id or short link
     * @param string $checklistId the checklist's id
     * @param string $checkItemId the check item's id
     * @param array  $data        check item data
     *
     * @return array
     */
    public function updateItem($id, $checklistId, $checkItemId, array $data)
    {
        return $this->put(
            $this->getPath($id).'/'.rawurlencode($checklistId).'/checkItem/'.rawurlencode($checkItemId),
            $data
        );
    }

    /**
     * Create a check item
     * @link https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem
     *
     * @param string $id          the card's id or short link
     * @param string $checklistId the checklist's id
     * @param string $name        check item name
     * @param array  $data        check item data
     *
     * @return array
     */
    public function createItem($id, $checklistId, $name, array $data = array())
    {
        $data['idChecklist'] = $checklistId;
        $data['name'] = $name;

        return $this->post($this->getPath($id).'/'.rawurlencode($checklistId).'/checkItem', $data);
    }

    /**
     * Convert a check item to card
     * @link https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem
     *
     * @param string $id          the card's id or short link
     * @param string $checklistId the checklist's id
     * @param string $checkItemId the check item's id
     *
     * @return array
     */
    public function convertItemToCard($id, $checklistId, $checkItemId)
    {
        return $this->post(
            $this->getPath($id).'/'.rawurlencode($checklistId).'/checkItem/'.rawurlencode($checkItemId).'/convertToCard'
        );
    }

    /**
     * Remove a check item from card
     * @link https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem
     *
     * @param string $id          the card's id or short link
     * @param string $checklistId the checklist's id
     * @param string $checkItemId the check item's id
     *
     * @return array
     */
    public function removeItem($id, $checklistId, $checkItemId)
    {
        return $this->delete(
            $this->getPath($id).'/'.rawurlencode($checklistId).'/checkItem/'.rawurlencode($checkItemId)
        );
    }
}
