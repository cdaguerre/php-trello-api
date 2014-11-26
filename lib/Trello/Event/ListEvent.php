<?php

namespace Trello\Event;

use Trello\Model\CardlistInterface;

class ListEvent extends AbstractEvent
{
    /**
     * @var CardlistInterface
     */
    protected $cardlist;

    /**
     * Set cardlist
     *
     * @param CardlistInterface $cardlist
     */
    public function setCardlist(CardlistInterface $cardlist)
    {
        $this->cardlist = $cardlist;
    }

    /**
     * Get cardlist
     *
     * @return CardlistInterface
     */
    public function getCardlist()
    {
        return $this->cardlist;
    }
}
