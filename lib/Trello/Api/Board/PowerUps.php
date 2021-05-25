<?php

namespace Trello\Api\Board;

use Trello\Api\AbstractApi;

/**
 * Trello Board PowerUps API
 * @link https://trello.com/docs/api/board
 *
 * Not implemented:
 * - https://trello.com/docs/api/board/#post-1-boards-board-id-powerups
 * - https://trello.com/docs/api/board/#delete-1-boards-board-id-powerups-powerup
 */
class PowerUps extends AbstractApi
{
    /**
     * Base path of board power ups api
     * @var string
     */
    protected $path = 'boards/#id#/boardPlugins';
   
    
    /**
     * Get all power ups that are enabled on the board
     * @link https://developer.atlassian.com/cloud/trello/rest/api-group-boards/#api-boards-id-plugins-get
     *
     * @param string $id  the board's id
     *
     * @return array
     */
    public function all($boardId, array $params = array())
    {
        return $this->get($this->getPath($boardId), $params);
    }
    
    /**
     * Enable a powerup on the board
     * @link https://developer.atlassian.com/cloud/trello/rest/api-group-boards/#api-boards-id-boardplugins-post
     *
     * @param string $boardId   the board's id
     * @param string $powerUpId the id of the powerUp that should be enabled
     *
     * @return array
     */
    public function enable($boardId, $powerUpId)
    {
        return $this->post($this->getPath($boardId), array('idPlugin' => $powerUpId));
    }
}
