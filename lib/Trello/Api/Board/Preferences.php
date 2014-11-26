<?php

namespace Trello\Api\Board;

use Trello\Api\AbstractApi;

/**
 * Trello Board Preferences API
 * @link https://trello.com/docs/api/board
 *
 * Not implemented:
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-background
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-calendarfeedenabled
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-cardaging
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-cardcovers
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-comments
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-invitations
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-permissionlevel
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-selfjoin
 * - https://trello.com/docs/api/board/#put-1-boards-board-id-prefs-voting
 */
class Preferences extends AbstractApi
{
    /**
     * Base path of board preferences api
     * @var string
     */
    protected $path = 'boards/#id#/prefs';
}
