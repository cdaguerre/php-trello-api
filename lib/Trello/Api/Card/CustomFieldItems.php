<?php

namespace Trello\Api\Card;

use Trello\Api\AbstractApi;

/**
 * Trello Card custom fields items API
 * @link https://developers.trello.com/docs/getting-started-custom-fields#section-custom-field-values-on-cards
 *
 */
class CustomFieldItems extends AbstractApi
{
    /**
     * Base path of cards api
     * @var string
     */
    protected $path = 'cards/#id#/';

    /**
     * Get custom fiedls items related to a given card
     * @link https://developers.trello.com/docs/getting-started-custom-fields#section-getting-customfielditems-for-cards
     *
     * @param string $id     the card's id or short link
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function all($id, array $params = array())
    {
        $params = array_merge($params, array('customFieldItems' => 'true'));
        $data = $this->get($this->getPath($id), $params);

        return array_key_exists('customFieldItems', $data) ? $data['customFieldItems'] : array();
    }

    /**
     * Update a given custom field value on a given card
     * @link https://developers.trello.com/docs/getting-started-custom-fields#section-setting-updating-customfielditems
     *
     * @param string $id            the card's id or short link
     * @param string $customFieldId the card's id or short link
     * @param array  $value        the member's id
     *
     * @return array
     */
    public function update($id, $customFieldId, $value = array())
    {
        $path = $this->getPath($id) . 'customField/' . rawurldecode($customFieldId) . '/item';

        return $this->put(
            $path,
            $value
        );
    }
}
