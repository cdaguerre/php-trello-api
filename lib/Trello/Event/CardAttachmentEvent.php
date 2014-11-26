<?php

namespace Trello\Event;

class CardAttachmentEvent extends CardEvent
{
    /**
     * @var array
     */
    protected $attachment;

    /**
     * Set attachment
     *
     * @param array $attachment
     */
    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;
    }

    /**
     * Get attachment
     *
     * @return array
     */
    public function getAttachment()
    {
        return $this->attachment;
    }
}
