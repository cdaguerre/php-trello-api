<?php

namespace Trello\Api;

use Trello\Exception\InvalidArgumentException;

/**
 * Trello Card API
 * @link https://trello.com/docs/api/card
 *
 * Unimplemented:
 * - https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-checklist-idchecklistcurrent-checkitem-idcheckitem
 * - https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem-idcheckitem-converttocard
 * - https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-markassociatednotificationsread
 */
class Card extends AbstractApi
{
    /**
     * Base path of cards api
     * @var string
     */
    protected $path = 'cards';

    /**
     * Card fields
     * @link https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-field
     * @var array
     */
    public static $fields = array(
        'badges',
        'checkItemStates',
        'closed',
        'dateLastActivity',
        'desc',
        'descData',
        'due',
        'email',
        'idBoard',
        'idChecklists',
        'idList',
        'idMembers',
        'idMembersVoted',
        'idShort',
        'idAttachmentCover',
        'manualCoverAttachment',
        'labels',
        'name',
        'pos',
        'shortLink',
        'shortUrl',
        'subscribed',
        'url',
    );

    /**
     * Find a card by id
     * @link https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink
     *
     * @param string $id     the card's id or short link
     * @param array  $params optional attributes
     *
     * @return array card info
     */
    public function show($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Create a card
     * @link https://trello.com/docs/api/card/#post-1-cards
     *
     * @param array  $params optional attributes
     *
     * @return array card info
     */
    public function create(array $params = array())
    {
        $this->validateRequiredParameters(array('idList', 'name'), $params);

        if (!array_key_exists('due', $params)) {
            $params['due'] = null;
        }
        if (!array_key_exists('urlSource', $params)) {
            $params['urlSource'] = null;
        }

        return $this->post($this->getPath(), $params);
    }
    
       /**
     * Create a checklist Item
     * @link https://trello.com/docs/api/card/#post-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem
     *
     * @param string $cardId id of the card the item is added to
     * @param string $checkListId id of the checklist the item is added to  
     * @param array  $params optional attributes
     *
     * @return array card info
     */

    public function createCheckListItem($cardId, $checkListId, $params = Array()){
        
        $this->validateRequiredParameters(array('idChecklist', 'name'), $params);

        return $this->post($this->getPath().'/'.rawurlencode($cardId).'/checklist/'.rawurlencode($checkListId).'/checkItem', $params);
    }

    /**
     * Update a card
     * @link https://trello.com/docs/api/card/#put-1-cards
     *
     * @param string $id     the card's id or short link
     * @param array  $params card attributes to update
     *
     * @return array card info
     */
    public function update($id, array $params = array())
    {
        return $this->put($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Set a given card's board
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-idboard
     *
     * @param string $id      the card's id or short link
     * @param string $boardId the board's id
     *
     * @return array board info
     */
    public function setBoard($id, $boardId)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/idBoard', array('value' => $boardId));
    }

    /**
     * Get a given card's board
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-idboard
     *
     * @param string $id     the card's id or short link
     * @param array  $params optional parameters
     *
     * @return array board info
     */
    public function getBoard($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/board', $params);
    }

    /**
     * Get the field of a board of a given card
     * @link https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-board-field
     *
     * @param string $id    the card's id
     * @param array  $field the name of the field
     *
     * @return array board info
     *
     * @throws InvalidArgumentException if the field does not exist
     */
    public function getBoardField($id, $field)
    {
        $this->validateAllowedParameters(Board::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/board/'.rawurlencode($field));
    }

    /**
     * Get the checkitemstates, for now will return the full list of checkitem states;
     * @link https://trello.com/docs/api/card/index.html#get-1-cards-card-id-or-shortlink-checkitemstates
     *
     * @param string $id     the card's id or short link
     *
     * @return array list info
     */
    public function getCheckItemStates($id){

        return $this->get($this->getPath().'/'.rawurlencode($id).'/checkItemStates', array('value' => 'all'));
    }
    
    /**
     * Get the checklists, for now will return the full list of checkitem states;
     * @link https://trello.readme.io/v1.0/reference#cardsidchecklists
     *
     * @param string $id     the card's id or short link
     * @param array $fields (optional) an array with the requested fields, all by default
     *
     * @return array checklist info
     */
    public function getCheckLists($id, array $fields = array('fields'=>'all')){

        return $this->get($this->getPath().'/'.rawurlencode($id).'/checklists', $fields);
        
    }
    
     /**
     * Get the members;
     * @link https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-members
     *
     * @param string $id the card's id or short link
     *
     * @return array list info
     */
    public function getMembers($id){
        return $this->get($this->getPath().'/'.rawurlencode($id).'/members', array('value' => 'all'));
    }
    /**
     * Set a given card's list
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-idlist
     *
     * @param string $id     the card's id or short link
     * @param string $listId the list's id
     *
     * @return array list info
     */
    public function setList($id, $listId)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/idList', array('value' => $listId));
    }

    /**
     * Get a given card's list
     * @link https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-list
     *
     * @param string $id     the card's id or short link
     * @param array  $params optional parameters
     *
     * @return array list info
     */
    public function getList($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/list', $params);
    }

    /**
     * Get the field of a list of a given card
     * @link https://trello.com/docs/api/card/#get-1-cards-card-id-or-shortlink-list-field
     *
     * @param string $id    the card's id
     * @param array  $field the name of the field
     *
     * @return array board info
     *
     * @throws InvalidArgumentException if the field does not exist
     */
    public function getListField($id, $field)
    {
        $this->validateAllowedParameters(Cardlist::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/list/'.rawurlencode($field));
    }

    /**
     * Set a given card's name
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-name
     *
     * @param string $id   the card's id or short link
     * @param string $name the name
     *
     * @return array card info
     */
    public function setName($id, $name)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/name', array('value' => $name));
    }

    /**
     * Set a given card's description
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-desc
     *
     * @param string $id          the card's id or short link
     * @param string $description the description
     *
     * @return array card info
     */
    public function setDescription($id, $description)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/desc', array('value' => $description));
    }

    /**
     * Set a given card's state
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-closed
     *
     * @param string $id     the card's id or short link
     * @param bool   $closed whether the card should be closed or not
     *
     * @return array card info
     */
    public function setClosed($id, $closed = true)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/closed', array('value' => $closed));
    }

    /**
     * Set a given card's due date
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-due
     *
     * @param string    $id   the card's id or short link
     * @param \DateTime $date the due date
     *
     * @return array card info
     */
    public function setDueDate($id, \DateTime $date = null)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/due', array('value' => $date));
    }

    /**
     * Set a given card's position
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-pos
     *
     * @param string         $id       the card's id or short link
     * @param string|integer $position the position, eg. 'top', 'bottom'
     *                                 or a positive number
     *
     * @return array card info
     */
    public function setPosition($id, $position)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/pos', array('value' => $position));
    }

    /**
     * Set a given card's subscription state
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-subscribed
     *
     * @param string $id         the list's id
     * @param bool   $subscribed subscription state
     *
     * @return array list info
     */
    public function setSubscribed($id, $subscribed)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/subscribed', array('value' => $subscribed));
    }


    /**
     * Set a given card's memberId
     * @link tbd
     *
     * @param string $id         the list's id
     * @param string $idMembers comma seperated list of responsible members
     *
     * @return array list info
     */
    public function setIdMembers($id, $idMembers)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/idMembers', array('value' => $idMembers));
    }
    
/**
     * Set a given checklist item name
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem-idcheckitem-name
     *
     * @param string $cardId the cards's id
     * @param string $checkListId the checklist's id
     * @param string $itemId the item's id
     * @param string   $name new name value
     *
     * @return array list info
     */
    public function setCheckListItemName($cardId,$checkListId,$itemId, $name)
    {
        return $this->put($this->getPath().'/'.rawurlencode($cardId).'/checklist/'.rawurlencode($checkListId).'/checkItem/'.rawurlencode($itemId).'/name', array('value' => $name));
    }

    /**
     * Set a given checklist item position
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem-idcheckitem-pos
     *
     * @param string $cardId the cards's id
     * @param string $checkListId the checklist's id
     * @param string $itemId the item's id
     * @param string $position new position value
     *
     * @return array list info
     */
    public function setCheckListItemPosition($cardId,$checkListId,$itemId, $position)
    {
        return $this->put($this->getPath().'/'.rawurlencode($cardId).'/checklist/'.rawurlencode($checkListId).'/checkItem/'.rawurlencode($itemId).'/pos', array('value' => $position));
    }

    /**
     * Set a given checklist item closed state
     * @link https://trello.com/docs/api/card/#put-1-cards-card-id-or-shortlink-checklist-idchecklist-checkitem-idcheckitem-state
     *
     * @param string $cardId the cards's id
     * @param string $checkListId the checklist's id
     * @param string $itemId the item's id
     * @param bool   $complete new complete value, defaults to true
     *
     * @return array list info
     */
    public function setCheckListItemClosed($cardId,$checkListId,$itemId, $complete = true)
    {
        return $this->put($this->getPath().'/'.rawurlencode($cardId).'/checklist/'.rawurlencode($checkListId).'/checkItem/'.rawurlencode($itemId).'/state', array('value' => $complete));
    }

    /**
     * Update checklist item by parameter array
     * @link https://trello.com/docs/api/card/index.html#put-1-cards-card-id-or-shortlink-checklist-idchecklistcurrent-checkitem-idcheckitem
     *
     * @param string $cardId the cards's id
     * @param string $checkListId the checklist's id
     * @param string $itemId the item's id
     * @param array $params item attributes to update
     *
     * @return array list info
     */
    public function updateCheckListItem($cardId,$checkListId,$itemId, $params = array())
    {
        return $this->put($this->getPath().'/'.rawurlencode($cardId).'/checklist/'.rawurlencode($checkListId).'/checkItem/'.rawurlencode($itemId), $params);
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
        return $this->get($this->getPath().'/'.rawurlencode($id).'/checkItem/'.rawurlencode($checkItemId), $params);
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
    public function updateCheckItem($id, $checkItemId, array $updateFields = array())
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/checkItem/'.rawurlencode($checkItemId), $updateFields);
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
        return $this->delete($this->getPath().'/'.rawurlencode($id).'/checkItem/'.rawurlencode($checkItemId));
    }

    /**
     * Actions API
     *
     * @return Card\Actions
     */
    public function actions()
    {
        return new Card\Actions($this->client);
    }

    /**
     * Attachments API
     *
     * @return Card\Attachments
     */
    public function attachments()
    {
        return new Card\Attachments($this->client);
    }

    /**
     * Checklists API
     *
     * @return Card\Checklists
     */
    public function checklists()
    {
        return new Card\Checklists($this->client);
    }

    /**
     * Labels API
     *
     * @return Card\Labels
     */
    public function labels()
    {
        return new Card\Labels($this->client);
    }

    /**
     * Members API
     *
     * @return Card\Members
     */
    public function members()
    {
        return new Card\Members($this->client);
    }

    /**
     * Stickers API
     *
     * @return Card\Stickers
     */
    public function stickers()
    {
        return new Card\Stickers($this->client);
    }

    /**
     * CustomFieldItems API
     *
     * @return Card\CustomFieldItems
     */
    public function customFieldItems()
    {
        return new Card\CustomFieldItems($this->client);
    }
}
