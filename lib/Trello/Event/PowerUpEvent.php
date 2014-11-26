<?php

namespace Trello\Event;

use Trello\Model\PowerUpInterface;

class PowerUpEvent extends AbstractEvent
{
    /**
     * @var PowerUpInterface
     */
    protected $powerUp;

    /**
     * Set powerUp
     *
     * @param PowerUpInterface $powerUp
     */
    public function setPowerUp(PowerUpInterface $powerUp)
    {
        $this->powerUp = $powerUp;
    }

    /**
     * Get powerUp
     *
     * @return PowerUpInterface
     */
    public function getPowerUp()
    {
        return $this->powerUp;
    }
}
