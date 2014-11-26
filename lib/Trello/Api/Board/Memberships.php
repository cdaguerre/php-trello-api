<?php

namespace Trello\Api\Board;

use Trello\Api\AbstractApi;

/**
 * Trello Board Memberships API
 * @link https://trello.com/docs/api/board
 *
 * Not implemented:
 * - https://trello.com/docs/api/board/#get-1-boards-board-id-memberships
 * - https://trello.com/docs/api/board/#get-1-boards-board-id-memberships-idmembership
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-memberships-idmembership
 */
class Memberships extends AbstractApi
{
    /**
     * Base path of board power ups api
     * @var string
     */
    protected $path = 'boards/#id#/memberships';
}
