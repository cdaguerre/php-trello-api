<?php

namespace Trello\Event;

use Trello\Model\LabelInterface;

class CardChecklistEvent extends CardEvent
{
    /**
     * @var LabelInterface
     */
    protected $checklist;

    /**
     * Set label
     *
     * @param LabelInterface $label
     */
    public function setLabel(LabelInterface $label)
    {
        $this->label = $label;
    }

    /**
     * Get label
     *
     * @return LabelInterface
     */
    public function getLabel()
    {
        return $this->label;
    }
}
