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
     * @param string $comment
     */
    public function setComment(string $comment)
    {
        $this->comment = $comment;
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
