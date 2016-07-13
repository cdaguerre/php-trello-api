<?php

namespace Trello\Event;

class CardCommentEvent extends CardEvent
{
    /**
     * @var string
     */
    protected $comment;

    /**
     * Set comment
     *
     * @param string $text
     */
    public function setComment($text)
    {
        $this->comment = $text;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
}
