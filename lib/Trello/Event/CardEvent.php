<?php

namespace Trello\Event;

use Trello\Model\CardInterface;

class CardEvent extends AbstractEvent
{
    /**
     * @var CardInterface
     */
    protected $card;

    /**
     * Set card
     *
     * @param CardInterface $card
     */
    public function setCard(CardInterface $card)
    {
        $this->card = $card;
    }

    /**
     * Get card
     *
     * @return CardInterface
     */
    public function getCard()
    {
        return $this->card;
    }
}
