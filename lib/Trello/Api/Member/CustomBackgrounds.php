<?php

namespace Trello\Api\Member;

use Trello\Api\AbstractApi;

/**
 * Trello Member Custom Backgrounds API
 * @link https://trello.com/docs/api/member
 *
 * Not implemented:
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-customboardbackgrounds
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-customboardbackgrounds-idboardbackground
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-customboardbackgrounds-idboardbackground
 * - https://trello.com/docs/api/member/#post-1-members-idmember-or-username-customboardbackgrounds
 * - https://trello.com/docs/api/member/#delete-1-members-idmember-or-username-customboardbackgrounds-idboardbackground
 */
class CustomBackgrounds extends AbstractApi
{
    protected $path = 'members/#id#/customBackgrounds';
}
