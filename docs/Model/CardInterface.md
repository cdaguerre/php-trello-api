
======================

### Get id Short
```php
getShortId()
```

### Set name
```php
setName(string $name)
```

### Get name
```php
getName()
```

### Set description
```php
setDescription(string $desc)
```

### Get description
```php
getDescription()
```

### Get descriptionData
```php
getDescriptionData()
```

### Get url
```php
getUrl()
```

### Get shortUrl
```php
getShortUrl()
```

### Get shortLink
```php
getShortLink()
```

### Set position
```php
setPosition(string $pos)
```

### Get position
```php
getPosition()
```

### Set dueDate
```php
setDueDate(string $due)
```

### Get dueDate
```php
getDueDate()
```

### Set email
```php
setEmail(string $email)
```

### Get email
```php
getEmail()
```

### Set closed
```php
setClosed(boolean $closed)
```

### Get closed
```php
isClosed()
```

### Set subscribed
```php
setSubscribed(boolean $subscribed)
```

### Get subscribed
```php
isSubscribed()
```

### Set checkItemStates
```php
setCheckItemStates(array $checkItemStates)
```

### Get checkItemStates
```php
getCheckItemStates()
```

### Set boardId
```php
setBoardId(string $boardId)
```

### Get boardId
```php
getBoardId()
```

### Set board
```php
setBoard(\Trello\Model\BoardInterface $board)
```

### Get board
```php
getBoard()
```

### Set listId
```php
setListId(string $listId)
```

### Get listId
```php
getListId()
```

### Set list
```php
setList(\Trello\Model\CardlistInterface $list)
```

### Get list
```php
getList()
```

### Set checklistIds
```php
setChecklistIds(array $checklistIds)
```

### Get checklistIds
```php
getChecklistIds()
```

### Set checklists
```php
setChecklists(array|array<mixed,\Trello\Model\ChecklistInterface> $checklists)
```

### Get checklists
```php
getChecklists()
```

### Has checklist
```php
hasChecklist(\Trello\Model\ChecklistInterface $checklist)
```

### Add checklist
```php
addChecklist(\Trello\Model\ChecklistInterface $checklist)
```

### Remove checklist
```php
removeChecklist(\Trello\Model\ChecklistInterface $checklist)
```

### Set memberIds
```php
setMemberIds(string $memberIds)
```

### Get memberIds
```php
getMemberIds()
```

### Has member
```php
hasMember(\Trello\Model\MemberInterface $member)
```

### Add member
```php
addMember(\Trello\Model\MemberInterface $member)
```

### Remove member
```php
removeMember(\Trello\Model\MemberInterface $member)
```

### Set members
```php
setMembers(string $members)
```

### Get members
```php
getMembers()
```

### Set membersVotedIds
```php
setMembersVotedIds(string $membersVotedIds)
```

### Get membersVotedIds
```php
getMembersVotedIds()
```

### Has member voted
```php
hasMemberVoted(\Trello\Model\MemberInterface $member)
```

### Add member voted
```php
addMemberVoted(\Trello\Model\MemberInterface $member)
```

### Remove member voted
```php
removeMemberVoted(\Trello\Model\MemberInterface $member)
```

### Set members voted
```php
setMembersVoted(array|array<mixed,\Trello\Model\MemberInterface> $members)
```

### Get members voted
```php
getMembersVoted()
```

### Set attachmentCoverId
```php
setAttachmentCoverId(string $attachmentCoverId)
```

### Get attachmentCoverId
```php
getAttachmentCoverId()
```

### Set manualCoverAttachment
```php
setManualCoverAttachment(string $coverAttachment)
```

### Get manualCoverAttachment
```php
getManualCoverAttachment()
```

### Set labels
```php
setLabels(array $labels)
```

### Get labels
```php
getLabels()
```

### Get the colors of labels associated to this card
```php
getLabelColors()
```

### Does the card have the label of which the color is $color?
```php
hasLabel(string $color)
```

### Add the label of color $color
```php
addLabel(string $color)
```

### Remove the label of color $color
```php
removeLabel(string $color)
```

### Set Badges
```php
setBadges(array $badges)
```

### Get badges
```php
getBadges()
```

### Get dateOfLastActivity
```php
getDateOfLastActivity()
```

