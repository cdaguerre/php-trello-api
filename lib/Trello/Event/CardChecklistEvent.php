<?php

namespace Trello\Event;

use Trello\Model\ChecklistInterface;

class CardChecklistEvent extends CardEvent
{
    /**
     * @var ChecklistInterface
     */
    protected $checklist;

    /**
     * Set checklist
     *
     * @param ChecklistInterface $checklist
     */
    public function setChecklist(ChecklistInterface $checklist)
    {
        $this->checklist = $checklist;
    }

    /**
     * Get checklist
     *
     * @return ChecklistInterface
     */
    public function getChecklist()
    {
        return $this->checklist;
    }
}
