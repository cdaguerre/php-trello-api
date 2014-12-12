<?php

namespace Trello\Api\Member;

use Trello\Api\AbstractApi;
use Trello\Events;

/**
 * Trello Member Notifications API
 * @link https://trello.com/docs/api/member
 *
 * Fully implemented.
 */
class Notifications extends AbstractApi
{
    protected $path = 'members/#id#/notifications';

    /**
     * Get notifications related to a given list
     * @link https://trello.com/docs/api/member/#get-1-members-idmember-or-username-notifications
     *
     * @param string $id     the member's id or username
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function all($id, array $params = array())
    {
        return $this->get($this->getPath($id), $params);
    }

    /**
     * Filter notifications related to a given member
     * @link https://trello.com/docs/api/member/#get-1-members-idmember-or-username-notifications-filter
     *
     * @param string $id    the member's id or username
     * @param array  $event one of the events defined in \Trello\Events or 'all'
     *
     * @return array
     */
    public function filter($id, $event = 'all')
    {
        $events = Events::all();
        $events[] = 'all';

        $events = $this->validateAllowedParameters($events, $event, 'event');

        return $this->get($this->getPath($id).'/'.implode(',', $events));
    }
}
