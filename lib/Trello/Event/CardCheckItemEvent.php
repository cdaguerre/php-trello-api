<?php

namespace Trello\Event;

use Trello\Model\CheckItemInterface;

class CardCheckItemEvent extends CardEvent
{
    /**
     * @var CheckItemInterface
     */
    protected $checkItem;

    /**
     * Set checkItem
     *
     * @param CheckItemInterface $checkItem
     */
    public function setCheckItem(CheckItemInterface $checkItem)
    {
        $this->checkItem = $checkItem;
    }

    /**
     * Get checkItem
     *
     * @return CheckItemInterface
     */
    public function getCheckItem()
    {
        return $this->checkItem;
    }
}
