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
    protected $path = 'cards/#id#/checklist';

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
        return $this->get($this->getPath($id), $params);
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
     * @param string $checklistId the checklist's id
     *
     * @return array
     */
    public function itemStates($id, array $params = array())
    {
        return $this->get('cards/'.rawurlencode($id).'/checkItemStates', $params);
    }
}
