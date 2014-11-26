<?php

namespace Trello\Event;

use Trello\Model\MemberInterface;

class MemberEvent extends AbstractEvent
{
    /**
     * @var MemberInterface
     */
    protected $member;

    /**
     * Set member
     *
     * @param MemberInterface $member
     */
    public function setMember(MemberInterface $member)
    {
        $this->member = $member;
    }

    /**
     * Get member
     *
     * @return MemberInterface
     */
    public function getMember()
    {
        return $this->member;
    }
}
