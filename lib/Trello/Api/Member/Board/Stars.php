<?php

namespace Trello\Api\Member\Board;

use Trello\Api\AbstractApi;

/**
 * Trello Member Board Stars API
 * @link https://trello.com/docs/api/member
 *
 * Not implemented:
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-boardstars
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-boardstars-idboardstar
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-boardstars-idboardstar
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-boardstars-idboardstar-idboard
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-boardstars-idboardstar-pos
 * - https://trello.com/docs/api/member/#post-1-members-idmember-or-username-boardstars
 * - https://trello.com/docs/api/member/#delete-1-members-idmember-or-username-boardstars-idboardstar
 */
class Stars extends AbstractApi
{
    protected $path = 'member/#id#/boardStars';
}
