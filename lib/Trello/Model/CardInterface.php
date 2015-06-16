<?php

namespace Trello\Model;

interface CardInterface extends ObjectInterface
{
    /**
     * Get id Short
     *
     * @return string
     */
    public function getShortId();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CardInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set description
     *
     * @param string $desc
     *
     * @return CardInterface
     */
    public function setDescription($desc);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get descriptionData
     *
     * @return string
     */
    public function getDescriptionData();

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl();

    /**
     * Get shortUrl
     *
     * @return string
     */
    public function getShortUrl();

    /**
     * Get shortLink
     *
     * @return string
     */
    public function getShortLink();

    /**
     * Set position
     *
     * @param string $pos
     *
     * @return CardInterface
     */
    public function setPosition($pos);

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition();

    /**
     * Set due date
     *
     * @param \DateTime $due
     *
     * @return CardInterface
     */
    public function setDueDate(\DateTime $due = null);

    /**
     * Get due date
     *
     * @return \DateTime
     */
    public function getDueDate();

    /**
     * Set email
     *
     * @param string $email
     *
     * @return CardInterface
     */
    public function setEmail($email);

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set closed
     *
     * @param bool $closed
     *
     * @return CardInterface
     */
    public function setClosed($closed);

    /**
     * Get closed
     *
     * @return bool
     */
    public function isClosed();

    /**
     * Set subscribed
     *
     * @param bool $subscribed
     *
     * @return CardInterface
     */
    public function setSubscribed($subscribed);

    /**
     * Get subscribed
     *
     * @return bool
     */
    public function isSubscribed();

    /**
     * Set checkItemStates
     *
     * @param array $checkItemStates
     *
     * @return CardInterface
     */
    public function setCheckItemStates(array $checkItemStates);

    /**
     * Get checkItemStates
     *
     * @return array
     */
    public function getCheckItemStates();

    /**
     * Set boardId
     *
     * @param string $boardId
     *
     * @return CardInterface
     */
    public function setBoardId($boardId);

    /**
     * Get boardId
     *
     * @return string
     */
    public function getBoardId();

    /**
     * Set board
     *
     * @param BoardInterface $board
     *
     * @return CardInterface
     */
    public function setBoard(BoardInterface $board);

    /**
     * Get board
     *
     * @return BoardInterface
     */
    public function getBoard();

    /**
     * Set listId
     *
     * @param string $listId
     *
     * @return CardInterface
     */
    public function setListId($listId);

    /**
     * Get listId
     *
     * @return string
     */
    public function getListId();

    /**
     * Set list
     *
     * @param CardlistInterface $list
     *
     * @return CardInterface
     */
    public function setList(CardlistInterface $list);

    /**
     * Get list
     *
     * @return CardlistInterface
     */
    public function getList();

    /**
     * Set checklistIds
     *
     * @param array $checklistIds
     *
     * @return CardInterface
     */
    public function setChecklistIds(array $checklistIds);

    /**
     * Get checklistIds
     *
     * @return array
     */
    public function getChecklistIds();

    /**
     * Set checklists
     *
     * @param array|ChecklistInterface[] $checklists
     *
     * @return CardInterface
     */
    public function setChecklists(array $checklists);

    /**
     * Get checklists
     *
     * @return array|ChecklistInterface[]
     */
    public function getChecklists();

    /**
     * Get checklist by name
     *
     * @return ChecklistInterface
     */
    public function getChecklist($name);

    /**
     * Has checklist?
     *
     * @param ChecklistInterface|string $checklistOrName
     *
     * @return bool
     */
    public function hasChecklist($checklistOrName);

    /**
     * Add checklist to card
     *
     * @param ChecklistInterface|string $checklistOrName
     *
     * @return CardInterface
     */
    public function addChecklist($checklistOrName);

    /**
     * Remove checklist from card
     *
     * This will only remove the checklist from this card,
     * without actually deleting it. Call ChecklistInterface::remove()
     * to removed it completely.
     *
     * @param ChecklistInterface|string $checklistOrName
     *
     * @return CardInterface
     */
    public function removeChecklist($checklistOrName);

    /**
     * Set member ids
     *
     * @param array $memberIds
     *
     * @return CardInterface
     */
    public function setMemberIds(array $memberIds);

    /**
     * Get member ids
     *
     * @return array
     */
    public function getMemberIds();

    /**
     * Has member
     *
     * @param MemberInterface $member
     *
     * @return bool
     */
    public function hasMember(MemberInterface $member);

    /**
     * Add member
     *
     * @param MemberInterface $member
     *
     * @return CardInterface
     */
    public function addMember(MemberInterface $member);

    /**
     * Remove member
     *
     * @param MemberInterface $member
     *
     * @return CardInterface
     */
    public function removeMember(MemberInterface $member);

    /**
     * Set members
     *
     * @param array|MemberInterface[] $members
     *
     * @return CardInterface
     */
    public function setMembers(array $members);

    /**
     * Get members
     *
     * @return array|MemberInterface[]
     */
    public function getMembers();

    /**
     * Set members voted ids
     *
     * @param array $membersVotedIds
     *
     * @return CardInterface
     */
    public function setMembersVotedIds(array $membersVotedIds);

    /**
     * Get members voted ids
     *
     * @return array
     */
    public function getMembersVotedIds();

    /**
     * Has member voted
     *
     * @param MemberInterface $member
     *
     * @return bool
     */
    public function hasMemberVoted(MemberInterface $member);

    /**
     * Add member voted
     *
     * @param MemberInterface $member
     *
     * @return CardInterface
     */
    public function addMemberVoted(MemberInterface $member);

    /**
     * Remove member voted
     *
     * @param MemberInterface $member
     *
     * @return CardInterface
     */
    public function removeMemberVoted(MemberInterface $member);

    /**
     * Set members voted
     *
     * @param array|MemberInterface[] $members
     *
     * @return CardInterface
     */
    public function setMembersVoted(array $members);

    /**
     * Get members voted
     *
     * @return array|MemberInterface[]
     */
    public function getMembersVoted();

    /**
     * Set attachmentCoverId
     *
     * @param string $attachmentCoverId
     *
     * @return CardInterface
     */
    public function setAttachmentCoverId($attachmentCoverId);

    /**
     * Get attachmentCoverId
     *
     * @return string
     */
    public function getAttachmentCoverId();

    /**
     * Set manualCoverAttachment
     *
     * @param string $coverAttachment
     *
     * @return CardInterface
     */
    public function setManualCoverAttachment($coverAttachment);

    /**
     * Get manualCoverAttachment
     *
     * @return string
     */
    public function getManualCoverAttachment();

    /**
     * Set labels
     *
     * @param array $labels
     *
     * @return CardInterface
     */
    public function setLabels(array $labels);

    /**
     * Get labels
     *
     * @return array
     */
    public function getLabels();

    /**
     * Get the colors of labels associated to this card
     *
     * @return array
     */
    public function getLabelColors();

    /**
     * Does the card have the label of which the color is $color?
     *
     * @param string $color
     *
     * @return bool
     */
    public function hasLabel($color);

    /**
     * Add the label of color $color
     *
     * @param string $color
     *
     * @return CardInterface
     */
    public function addLabel($color);

    /**
     * Remove the label of color $color
     *
     * @param string $color
     *
     * @return CardInterface
     */
    public function removeLabel($color);

    /**
     * Set Badges
     *
     * @param array $badges an array with the following keys:
     *                      - votes              integer
     *                      - viewingMemberVoted bool
     *                      - subscribed         bool
     *                      - fogbugz            string
     *                      - checkItems         integer
     *                      - checkItemsChecked  integer
     *                      - comments           integer
     *                      - attachments        integer
     *                      - description        bool
     *                      - due                \DateTime
     *
     * @return CardInterface
     */
    public function setBadges(array $badges);

    /**
     * Get badges
     *
     * @return array
     */
    public function getBadges();

    /**
     * Get dateOfLastActivity
     *
     * @return \DateTime
     */
    public function getDateOfLastActivity();

    /**
     * Get actions
     *
     * @return array
     */
    public function getActions();

    /**
     * Add comment
     *
     * @param string $text comment text
     *
     * @return CardInterface
     */
    public function addComment($text);

    /**
     * Remove comment
     *
     * @param string $commentId id of the comment to remove
     *
     * @return CardInterface
     */
    public function removeComment($commentId);
}
