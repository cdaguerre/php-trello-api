<?php

namespace Trello\Api\Member\Board;

use Trello\Api\AbstractApi;

/**
 * Trello Member Board Backgrounds API
 * @link https://trello.com/docs/api/member
 *
 * Not implemented:
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-boardbackgrounds
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-boardbackgrounds-idboardbackground
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-boardbackgrounds-idboardbackground
 * - https://trello.com/docs/api/member/#post-1-members-idmember-or-username-boardbackgrounds
 * - https://trello.com/docs/api/member/#delete-1-members-idmember-or-username-boardbackgrounds-idboardbackground
 */
class Backgrounds extends AbstractApi
{
    protected $path = 'member/#id#/boardBackgrounds';
}
