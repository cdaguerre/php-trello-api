<?php

namespace Trello\Api\Member;

use Trello\Api\AbstractApi;

/**
 * Trello Member Saved Searches API
 * @link https://trello.com/docs/api/member
 *
 * Not implemented:
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-savedsearches
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-savedsearches-idsavedsearch
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-savedsearches-idsavedsearch
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-savedsearches-idsavedsearch-name
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-savedsearches-idsavedsearch-pos
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-savedsearches-idsavedsearch-query
 * - https://trello.com/docs/api/member/#post-1-members-idmember-or-username-savedsearches
 * - https://trello.com/docs/api/member/#delete-1-members-idmember-or-username-savedsearches-idsavedsearch
 */
class SavedSearches extends AbstractApi
{
    protected $path = 'members/#id#/savedSearches';
}
