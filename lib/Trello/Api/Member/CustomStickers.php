<?php

namespace Trello\Api\Member;

use Trello\Api\AbstractApi;

/**
 * Trello Member Custom Stickers API
 * @link https://trello.com/docs/api/member
 *
 * Not implemented:
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-customstickers
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-customstickers-idcustomsticker
 * - https://trello.com/docs/api/member/#post-1-members-idmember-or-username-customstickers
 * - https://trello.com/docs/api/member/#delete-1-members-idmember-or-username-customstickers-idcustomsticker
 */
class CustomStickers extends AbstractApi
{
    protected $path = 'members/#id#/customStickers';
}
