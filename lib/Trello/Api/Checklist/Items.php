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

    public static $fields = array(
        'name',
        'nameData',
        'type',
        'pos',
        'state',
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
     * @param array  $data    optional attributes
     *
     * @return array
     */
    public function create($id, $name, $checked = false, array $data = array())
    {
        $data['checked'] = $checked;
        $data['name'] = $name;

        return $this->post($this->getPath($id), $data);
    }

    /**
     * Update an item in the given checklist
     *
     * FIXME
     * There is no put method on checklist items, so this is
     * a dirty workaround which works by deleting the item
     * and recreating it.
     *
     * @param string $id     Id of the checklist
     * @param string $itemId the id of the item to update
     * @param array  $data   check item data
     *
     * @return array
     */
    public function update($id, $itemId, array $data)
    {
        $this->validateRequiredParameters(array('name', 'state'), $data);

        $this->remove($id, $itemId);

        return $this->create($id, $data['name'], $data['state'], $data);
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
