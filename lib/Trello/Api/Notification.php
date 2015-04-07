<?php

namespace Trello\Api;

use Trello\Exception\InvalidArgumentException;

/**
 * Trello Notification API
 * @link https://trello.com/docs/api/notification
 *
 * Fully implemented.
 */
class Notification extends AbstractApi
{
    /**
     * Base path of notifications api
     * @var string
     */
    protected $path = 'notifications';

    /**
     * Notification fields
     * @link https://trello.com/docs/api/notification/#get-1-notifications-idnotification-field
     * @var array
     */
    public static $fields = array(
        'unread',
        'type',
        'date',
        'data',
        'idMemberCreator',
    );

    /**
     * Find a notification by id
     * @link https://trello.com/docs/api/notification/#get-1-notifications-idnotification
     *
     * @param string $id     the notification's id
     * @param array  $params optional attributes
     *
     * @return array
     */
    public function show($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Update a notification
     * @link https://trello.com/docs/api/notification/#put-1-notifications-idnotification
     *
     * @param string $id   the notification's id
     * @param array  $data attributes to update
     *
     * @return arrays
     */
    public function update($id, array $data)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id), $data);
    }

    /**
     * Set a notification's unread status
     * @link https://trello.com/docs/api/notification/#put-1-notifications-idnotification-unread
     *
     * @param string $id     the notification's id
     * @param bool   $status true for unread, false for read
     *
     * @return arrays
     */
    public function setUnread($id, $status)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/unread', array('value' => $status));
    }

    /**
     * Set all notification's as read
     * @link https://trello.com/docs/api/notification/#put-1-notifications-idnotification-unread
     *
     * @return array
     */
    public function setAllRead()
    {
        return $this->post($this->getPath().'/all/read');
    }

    /**
     * Get a given notification's entities
     * @link https://trello.com/docs/api/notification/#get-1-notifications-notification-id-entities
     *
     * @param string $id     the notification's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getEntities($id, array $params = array())
    {
        return $this->get($this->path.'/'.rawurlencode($id).'/entities', $params);
    }

    /**
     * Get a notification's board
     * @link https://trello.com/docs/api/notification/#get-1-notifications-idnotification-board
     *
     * @param string $id     the notification's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getBoard($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/board', $params);
    }

    /**
     * Get the field of a board of a given card
     * @link https://trello.com/docs/api/notification/#get-1-notifications-idnotification-board
     *
     * @param string $id    the notification's id
     * @param array  $field the name of the field
     *
     * @return array
     *
     * @throws InvalidArgumentException if the field does not exist
     */
    public function getBoardField($id, $field)
    {
        $this->validateAllowedParameters(Board::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/board/'.rawurlencode($field));
    }

    /**
     * Get a notification's list
     * @link https://trello.com/docs/api/notification/#get-1-notifications-idnotification-list
     *
     * @param string $id     the notification's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getList($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/list', $params);
    }

    /**
     * Get the field of a list of a given notification
     * @link https://trello.com/docs/api/notification/index.html#get-1-notifications-idnotification-list-field
     *
     * @param string $id    the notification's id
     * @param array  $field the name of the field
     *
     * @return array
     *
     * @throws InvalidArgumentException if the field does not exist
     */
    public function getListField($id, $field)
    {
        $this->validateAllowedParameters(Cardlist::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/list/'.rawurlencode($field));
    }

    /**
     * Get a notification's card
     * @link https://trello.com/docs/api/notification/#get-1-notifications-idnotification-card
     *
     * @param string $id     the notification's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getCard($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/card', $params);
    }

    /**
     * Get the field of a card of a given notification
     * @link https://trello.com/docs/api/notification/index.html#get-1-notifications-idnotification-card-field
     *
     * @param string $id    the notification's id
     * @param array  $field the name of the field
     *
     * @return array
     *
     * @throws InvalidArgumentException if the field does not exist
     */
    public function getCardField($id, $field)
    {
        $this->validateAllowedParameters(Card::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/card/'.rawurlencode($field));
    }

    /**
     * Get a notification's member
     * @link https://trello.com/docs/api/notification/#get-1-notifications-idnotification-member
     *
     * @param string $id     the notification's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getMember($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/member', $params);
    }

    /**
     * Get the field of a member of a given notification
     * @link https://trello.com/docs/api/notification/#get-1-notifications-idnotification-member-field
     *
     * @param string $id    the notification's id
     * @param array  $field the name of the field
     *
     * @return array
     *
     * @throws InvalidArgumentException if the field does not exist
     */
    public function getMemberField($id, $field)
    {
        $this->validateAllowedParameters(Member::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/member/'.rawurlencode($field));
    }

    /**
     * Get a notification's creator
     * @link https://trello.com/docs/api/notification/#get-1-notifications-idnotification-creator
     *
     * @param string $id     the notification's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getCreator($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/memberCreator', $params);
    }

    /**
     * Get the field of a creator of a given notification
     * @link https://trello.com/docs/api/notification/#get-1-notifications-idnotification-creator-field
     *
     * @param string $id    the notification's id
     * @param array  $field the name of the field
     *
     * @return array
     *
     * @throws InvalidArgumentException if the field does not exist
     */
    public function getCreatorField($id, $field)
    {
        $this->validateAllowedParameters(Member::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/memberCreator/'.rawurlencode($field));
    }

    /**
     * Get a notification's organization
     * @link https://trello.com/docs/api/notification/#get-1-notifications-idnotification-organization
     *
     * @param string $id     the notification's id
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getOrganization($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id).'/organization', $params);
    }

    /**
     * Get the field of an organization of a given notification
     * @link https://trello.com/docs/api/notification/#get-1-notifications-idnotification-organization-field
     *
     * @param string $id    the notification's id
     * @param array  $field the name of the field
     *
     * @return array
     *
     * @throws InvalidArgumentException if the field does not exist
     */
    public function getOrganizationField($id, $field)
    {
        $this->validateAllowedParameters(Organization::$fields, $field, 'field');

        return $this->get($this->getPath().'/'.rawurlencode($id).'/organization/'.rawurlencode($field));
    }
}
