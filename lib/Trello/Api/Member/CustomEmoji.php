<?php

namespace Trello\Api\Member;

use Trello\Api\AbstractApi;

/**
 * Trello Member Custom Emoji API
 * @link https://trello.com/docs/api/member
 *
 * Not implemented:
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-customemoji
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-customemoji-idcustomemoji
 * - https://trello.com/docs/api/member/#post-1-members-idmember-or-username-customemoji
 */
class CustomEmoji extends AbstractApi
{
    protected $path = 'members/#id#/customEmoji';
}
