<?php

namespace Trello\Api\Checklist;

use Trello\Api\AbstractApi;

/**
 * Trello Checklist Items API
 * @link https://trello.com/docs/api/checklist
 *
 * Fully implemented.
 */
class Items extends AbstractApi
{
    protected $path = 'checklists/#id#/checkItems';

    protected $fields = array(
        'name',
        'nameData',
        'type',
        'pos',
        'state'
    );

    /**
     * Get items related to a given checklist
     * @link https://trello.com/docs/api/checklist/#get-1-checklists-idchecklist-checkitems
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
     * Create an item in the given checklist
     * @link https://trello.com/docs/api/checklist/#post-1-checklists-idchecklist-checkitems
     *
     * @param string $id      Id of the checklist
     * @param string $name    Name of the item
     * @param bool   $checked Check status
     * @param array  $params  optional attributes
     *
     * @return array
     */
    public function create($id, $name, $checked = false, array $params = array())
    {
        $params['checked'] = $checked;
        $params['name'] = $name;

        return $this->post($this->getPath($id), $params);
    }

    /**
     * Remove an item from checklist
     * @link https://trello.com/docs/api/checklist/#delete-1-checklists-idchecklist-checkitems-idcheckitem
     *
     * @param string $id     the id of the checklist the item should be removed from
     * @param string $itemId the id of the item to delete
     *
     * @return array card info
     */
    public function remove($id, $itemId)
    {
        return $this->delete($this->getPath($id).'/'.rawurlencode($itemId));
    }
}
