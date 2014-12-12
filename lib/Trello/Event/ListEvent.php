<?php

namespace Trello\Event;

use Trello\Model\CardlistInterface;

class ListEvent extends AbstractEvent
{
    /**
     * @var CardlistInterface
     */
    protected $list;

    /**
     * Set cardlist
     *
     * @param CardlistInterface $list
     */
    public function setList(CardlistInterface $list)
    {
        $this->list = $list;
    }

    /**
     * Get cardlist
     *
     * @return CardlistInterface
     */
    public function getList()
    {
        return $this->list;
    }
}
