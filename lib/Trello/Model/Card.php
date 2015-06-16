<?php

namespace Trello\Model;

use Trello\Events;
use Trello\Exception\InvalidArgumentException;
use Trello\Exception\RuntimeException;

/**
 * @codeCoverageIgnore
 */
class Card extends AbstractObject implements CardInterface
{
    protected $apiName = 'card';

    protected $loadParams = array(
        'fields'          => 'all',
        'board'           => true,
        'list'            => true,
        'stickers'        => true,
        'members'         => true,
        'membersVoted'    => true,
        'attachments'     => true,
        'checklists'      => 'all',
        'checkItemStates' => true,
        'actions'         => Events::CARD_COMMENT,
    );

    protected $newChecklists = array();
    protected $newComments = array();
    protected $commentsToBeRemoved = array();

    /**
     * {@inheritdoc}
     */
    public function getShortId()
    {
        return $this->data['idShort'];
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->data['name'] = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->data['name'];
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($desc)
    {
        $this->data['desc'] = $desc;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->data['desc'];
    }

    /**
     * {@inheritdoc}
     */
    public function getDescriptionData()
    {
        return $this->data['descData'];
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        return $this->data['url'];
    }

    /**
     * {@inheritdoc}
     */
    public function getShortUrl()
    {
        return $this->data['shortUrl'];
    }

    /**
     * {@inheritdoc}
     */
    public function getShortLink()
    {
        return $this->data['shortLink'];
    }

    /**
     * {@inheritdoc}
     */
    public function setPosition($pos)
    {
        $this->data['pos'] = $pos;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition()
    {
        return $this->data['pos'];
    }

    /**
     * {@inheritdoc}
     */
    public function setDueDate(\DateTime $due = null)
    {
        $this->data['due'] = $due;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDueDate()
    {
        if ($this->data['due'] instanceof \DateTime) {
            return $this->data['due'];
        }

        return new \DateTime($this->data['due']);
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail($email)
    {
        $this->data['email'] = $email;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->data['email'];
    }

    /**
     * {@inheritdoc}
     */
    public function setClosed($closed)
    {
        $this->data['closed'] = $closed;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isClosed()
    {
        return $this->data['closed'];
    }

    /**
     * {@inheritdoc}
     */
    public function setSubscribed($subscribed)
    {
        $this->data['subscribed'] = $subscribed;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isSubscribed()
    {
        return $this->data['subscribed'];
    }

    /**
     * {@inheritdoc}
     */
    public function setCheckItemStates(array $checkItemStates)
    {
        $this->data['checkItemStates'] = $checkItemStates;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCheckItemStates()
    {
        return $this->data['checkItemStates'];
    }

    /**
     * {@inheritdoc}
     */
    public function setBoardId($boardId)
    {
        $this->data['idBoard'] = $boardId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBoardId()
    {
        return $this->data['idBoard'];
    }

    /**
     * {@inheritdoc}
     */
    public function setBoard(BoardInterface $board)
    {
        return $this->setBoardId($board->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function getBoard()
    {
        return new Board($this->client, $this->getBoardId());
    }

    /**
     * {@inheritdoc}
     */
    public function setListId($listId)
    {
        $this->data['idList'] = $listId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getListId()
    {
        return $this->data['idList'];
    }

    /**
     * {@inheritdoc}
     */
    public function setList(CardlistInterface $list)
    {
        return $this->setListId($list->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function getList()
    {
        return new Cardlist($this->client, $this->getListId());
    }

    public function moveToList($name)
    {
        foreach ($this->getBoard()->getLists() as $list) {
            if ($list->getName() === $name) {
                $this->setList($list);

                return $this;
            }
        }

        throw new InvalidArgumentException(sprintf(
            'Card "%s" could not be moved to list "%s" as no list with that name exists on the board named "%s"',
            $this->getName(),
            $name,
            $this->getBoard()->getName()
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setChecklistIds(array $checklistIds)
    {
        $this->data['idChecklists'] = $checklistIds;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getChecklistIds()
    {
        return $this->data['idChecklists'];
    }

    /**
     * {@inheritdoc}
     */
    public function setChecklists(array $checklists)
    {
        $ids = array();

        foreach ($checklists as $checklist) {
            $ids[] = $checklist->getId();
        }

        return $this->setChecklistIds($ids);
    }

    /**
     * {@inheritdoc}
     */
    public function getChecklists()
    {
        $checklists = array();

        foreach ($this->getChecklistIds() as $id) {
            $checklists[] = new Checklist($this->client, $id);
        }

        $checklists = array_merge($checklists, $this->newChecklists);

        return $checklists;
    }

    /**
     * {@inheritdoc}
     * @param string $name
     */
    public function getChecklist($name)
    {
        foreach ($this->getChecklists() as $checklist) {
            if ($checklist->getName() === $name) {
                return $checklist;
            }
        }

        throw new InvalidArgumentException(sprintf(
            'There is no checklist named "%s"  on this card (%s).',
            $name,
            $this->getName()
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function hasChecklist($checklist)
    {
        if ($checklist instanceof ChecklistInterface) {
            return in_array($checklist->getId(), $this->data['idChecklists']);
        }

        foreach ($this->getChecklists() as $existingList) {
            if ($existingList->getName() === $checklist) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function addChecklist($checklist)
    {
        if (!$this->id) {
            throw new RuntimeException("You can't add checklists to a new card, you have to save it first.");
        }

        if (!$checklist instanceof ChecklistInterface) {
            $name = $checklist;
            $checklist = new Checklist($this->client);
            $checklist->setName($name);
        }

        $checklist->setCard($this);

        if (!$checklist->getId()) {
            $this->newChecklists[] = $checklist;

            return $this;
        }

        if ($this->hasChecklist($checklist)) {
            throw new InvalidArgumentException(sprintf(
                'Checklist %s is already on this card (%s).',
                $checklist->getName(),
                $this->getName()
            ));
        }

        $this->data['idChecklists'][] = $checklist->getId();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeChecklist($checklist)
    {
        if (!$this->hasChecklist($checklist)) {
            throw new InvalidArgumentException(sprintf(
                "Checklist %s is not on this card (%s), so you can't remove it.",
                is_object($checklist) ? $checklist->getName() : $checklist,
                $this->getName()
            ));
        }

        if (!$checklist instanceof ChecklistInterface) {
            $checklist = $this->getChecklist($checklist);
        }

        foreach ($this->data['idChecklists'] as $key => $checklistId) {
            if ($checklistId === $checklist->getId()) {
                unset($this->data['idChecklists'][$key]);
                $checklist->remove();
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setMemberIds(array $memberIds)
    {
        $this->data['idMembers'] = $memberIds;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMemberIds()
    {
        return $this->data['idMembers'];
    }

    /**
     * {@inheritdoc}
     */
    public function hasMember(MemberInterface $member)
    {
        return in_array($member->getId(), $this->data['idMembers']);
    }

    /**
     * {@inheritdoc}
     */
    public function addMember(MemberInterface $member)
    {
        if ($this->hasMember($member)) {
            throw new InvalidArgumentException(sprintf(
                'Member %s is already on this card (%s).',
                $member->getFullName(),
                $this->getName()
            ));
        }

        $this->data['idMembers'][] = $member->getId();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeMember(MemberInterface $member)
    {
        if (!$this->hasMember($member)) {
            throw new InvalidArgumentException(sprintf(
                "Member %s is not on this card (%s), so you can't remove him.",
                $member->getFullName(),
                $this->getName()
            ));
        }

        foreach ($this->data['idMembers'] as $key => $memberArray) {
            if ($memberArray['id'] === $member->getId()) {
                unset($this->data['idMembers'][$key]);
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setMembers(array $members)
    {
        $ids = array();

        foreach ($members as $member) {
            $ids[] = $member->getId();
        }

        return $this->setMemberIds($ids);
    }

    /**
     * {@inheritdoc}
     */
    public function getMembers()
    {
        $members = array();

        foreach ($this->getMemberIds() as $id) {
            $members[] = new Member($this->client, $id);
        }

        return $members;
    }

    /**
     * {@inheritdoc}
     */
    public function setMembersVotedIds(array $membersVotedIds)
    {
        $this->data['idMembersVoted'] = $membersVotedIds;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMembersVotedIds()
    {
        return $this->data['idMembersVoted'];
    }

    /**
     * {@inheritdoc}
     */
    public function hasMemberVoted(MemberInterface $member)
    {
        return in_array($member->getId(), $this->data['idMembersVoted']);
    }

    /**
     * {@inheritdoc}
     */
    public function addMemberVoted(MemberInterface $member)
    {
        if ($this->hasMemberVoted($member)) {
            throw new InvalidArgumentException(sprintf(
                'Member %s has already voted this card (%s).',
                $member->getFullName(),
                $this->getName()
            ));
        }

        $this->data['idMembersVoted'][] = $member->getId();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeMemberVoted(MemberInterface $member)
    {
        if (!$this->hasMemberVoted($member)) {
            throw new InvalidArgumentException(sprintf(
                "Member %s hasn't voted this card (%s), so you can't remove his vote.",
                $member->getFullName(),
                $this->getName()
            ));
        }

        foreach ($this->data['idMembersVoted'] as $key => $memberArray) {
            if ($memberArray['id'] === $member->getId()) {
                unset($this->data['idMembersVoted'][$key]);
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setMembersVoted(array $members)
    {
        $ids = array();

        foreach ($members as $member) {
            $ids[] = $member->getId();
        }

        return $this->setMembersVotedIds($ids);
    }

    /**
     * {@inheritdoc}
     */
    public function getMembersVoted()
    {
        $members = array();

        foreach ($this->getMembersVotedIds() as $id) {
            $members[] = new Member($this->client, $id);
        }

        return $members;
    }

    /**
     * {@inheritdoc}
     */
    public function setAttachmentCoverId($attachmentCoverId)
    {
        $this->data['idAttachmentCover'] = $attachmentCoverId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttachmentCoverId()
    {
        return $this->data['idAttachmentCover'];
    }

    /**
     * {@inheritdoc}
     */
    public function setManualCoverAttachment($coverAttachment)
    {
        $this->data['manualCoverAttachment'] = $coverAttachment;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getManualCoverAttachment()
    {
        return $this->data['manualCoverAttachment'];
    }

    /**
     * {@inheritdoc}
     */
    public function setLabels(array $labels)
    {
        $this->data['labels'] = $labels;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLabels()
    {
        return $this->data['labels'];
    }

    /**
     * {@inheritdoc}
     */
    public function getLabelColors()
    {
        return array_map(function ($label) {
            return $label['color'];
        }, $this->data['labels']);
    }

    /**
     * {@inheritdoc}
     */
    public function hasLabel($color)
    {
        return in_array($color, $this->getLabelColors());
    }

    /**
     * {@inheritdoc}
     */
    public function addLabel($color)
    {
        if ($this->hasLabel($color)) {
            throw new InvalidArgumentException(sprintf(
                'Card %s already has the %s label.',
                $this->getName(),
                $color
            ));
        }

        $this->data['labels'][] = array('color' => $color);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeLabel($color)
    {
        if (!$this->hasLabel($color)) {
            throw new InvalidArgumentException(sprintf(
                "Can't remove the %s label because card %s doesn't have it.",
                $color,
                $this->getName()
            ));
        }

        foreach ($this->data['labels'] as $key => $label) {
            if ($label['color'] === $color) {
                unset($this->data['labels'][$key]);
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setBadges(array $badges)
    {
        $this->data['badges'] = $badges;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBadges()
    {
        return $this->data['badges'];
    }

    /**
     * {@inheritdoc}
     */
    public function getDateOfLastActivity()
    {
        return new \DateTime($this->data['dateLastActivity']);
    }

    /**
     * {@inheritdoc}
     */
    public function getActions($params = array())
    {
        return $this->api->actions()->all($this->id, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function addComment($text)
    {
        $this->newComments[] = $text;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeComment($commentId)
    {
        $this->commentsToBeRemoved[] = $commentId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function preSave()
    {
        foreach ($this->newChecklists as $checklist) {
            $checklist->save();
            $this->addChecklist($checklist);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function postSave()
    {
        foreach ($this->newComments as $key => $text) {
            $this->api->actions()->addComment($this->id, $text);
            unset($this->newComments[$key]);
        }

        foreach ($this->commentsToBeRemoved as $key => $commentId) {
            $this->api->actions()->removeComment($this->id, $commentId);
            unset($this->commentsToBeRemoved[$key]);
        }
    }
}
