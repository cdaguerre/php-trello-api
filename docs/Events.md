Trello API events
======================

```php
const BOARD_CREATE = 'createBoard'
```
When a board is created
The event listener method receives a Trello\Event\BoardEvent instance.



```php
const BOARD_UPDATE = 'updateBoard'
```
When a board is updated
The event listener method receives a Trello\Event\BoardEvent instance.



```php
const BOARD_COPY = 'copyBoard'
```
When a board is copied
The event listener method receives a Trello\Event\BoardEvent instance.



```php
const BOARD_MOVE_CARD_FROM = 'moveCardFromBoard'
```
When a card is moved from a board
The event listener method receives a Trello\Event\CardMoveEvent instance.



```php
const BOARD_MOVE_CARD_TO = 'moveCardToBoard'
```
When a card is moved to a board
The event listener method receives a Trello\Event\CardMoveEvent instance.



```php
const BOARD_MOVE_LIST_FROM = 'moveListFromBoard'
```
When a card is moved from a board
The event listener method receives a Trello\Event\ListMoveEvent instance.



```php
const BOARD_MOVE_LIST_TO = 'moveListToBoard'
```
When a card is moved to a board
The event listener method receives a Trello\Event\ListMoveEvent instance.



```php
const BOARD_ADD_MEMBER = 'addMemberToBoard'
```
When a member is added to a board
The event listener method receives a Trello\Event\BoardMemberEvent instance.



```php
const BOARD_MAKE_ADMIN = 'makeAdminOfBoard'
```
When a member becomes admin of a board
The event listener method receives a Trello\Event\BoardMemberEvent instance.



```php
const BOARD_MAKE_NORMAL_MEMBER = 'makeNormalMemberOfBoard'
```
When a member becomes normal member of a board
The event listener method receives a Trello\Event\BoardMemberEvent instance.



```php
const BOARD_MAKE_OBSERVER = 'makeObserverOfBoard'
```
When a member becomes observer of a board
The event listener method receives a Trello\Event\BoardMemberEvent instance.



```php
const BOARD_REMOVE_ADMIN = 'removeAdminFromBoard'
```
When a member looses admin rights on a board
The event listener method receives a Trello\Event\BoardMemberEvent instance.



```php
const BOARD_DELETE_INVITATION = 'deleteBoardInvitation'
```
When an invitation is deleted
The event listener method receives a Trello\Event\BoardMemberEvent instance.



```php
const BOARD_UNCONFIRMED_INVITATION = 'unconfirmedBoardInvitation'
```
When an invitation is in unconfirmed state
The event listener method receives a Trello\Event\BoardMemberEvent instance.



```php
const BOARD_ADD_TO_ORGANIZATION = 'addToOrganizationBoard'
```
When a board is added to an organization
The event listener method receives a Trello\Event\BoardOrganizationEvent instance.



```php
const BOARD_REMOVE_FROM_ORGANIZATION = 'removeFromOrganizationBoard'
```
When a board is removed from an organization
The event listener method receives a Trello\Event\BoardOrganizationEvent instance.



```php
const LIST_CREATE = 'createList'
```
When a list is created
The event listener method receives a Trello\Event\ListEvent instance.



```php
const LIST_UPDATE = 'updateList'
```
When a list is updated
The event listener method receives a Trello\Event\ListEvent instance.



```php
const LIST_UPDATE_CLOSED = 'updateList:closed'
```
When a list's closed state changes
The event listener method receives a Trello\Event\ListEvent instance.



```php
const LIST_UPDATE_NAME = 'updateList:name'
```
When a list's name changes
The event listener method receives a Trello\Event\ListEvent instance.



```php
const CARD_CREATE = 'createCard'
```
When a card is created
The event listener method receives a Trello\Event\CardEvent instance.



```php
const CARD_UPDATE = 'updateCard'
```
When a card is updated
The event listener method receives a Trello\Event\CardEvent instance.



```php
const CARD_UPDATE_LIST = 'updateCard:idList'
```
When a card is moved to an other list
The event listener method receives a Trello\Event\CardMoveEvent instance.



```php
const CARD_UPDATE_NAME = 'updateCard:name'
```
When a card's name is updated
The event listener method receives a Trello\Event\CardEvent instance.



```php
const CARD_UPDATE_DESC = 'updateCard:desc'
```
When a card's description is updated
The event listener method receives a Trello\Event\CardEvent instance.



```php
const CARD_UPDATE_CLOSED = 'updateCard:closed'
```
When a card's closed state changes
The event listener method receives a Trello\Event\CardEvent instance.



```php
const CARD_DELETE = 'deleteCard'
```
When a card is deleted
The event listener method receives a Trello\Event\CardEvent instance.



```php
const CARD_COPY = 'copyCard'
```
When a card is copied
The event listener method receives a Trello\Event\CardCopyEvent instance.



```php
const CARD_ADD_MEMBER = 'addMemberToCard'
```
When a new member is added to a card
The event listener method receives a Trello\Event\CardMemberEvent instance.



```php
const CARD_REMOVE_MEMBER = 'removeMemberFromCard'
```
When a new member is removed from a card
The event listener method receives a Trello\Event\CardMemberEvent instance.



```php
const CARD_COMMENT = 'commentCard'
```
When a comment is added to a card
The event listener method receives a Trello\Event\CardCommentEvent instance.



```php
const CARD_COPY_COMMENT = 'copyCommentCard'
```
When a card's comment is copied
The event listener method receives a Trello\Event\CardCommentEvent instance.



```php
const CARD_FROM_CHECKITEM = 'convertToCardFromCheckItem'
```
When a card is created from a check item
The event listener method receives a Trello\Event\CardFromCheckItemEvent instance.



```php
const CARD_ADD_ATTACHMENT = 'addAttachmentToCard'
```
When an attachment is added to a card
The event listener method receives a Trello\Event\CardAttachmentEvent instance.



```php
const CARD_DELETE_ATTACHMENT = 'deleteAttachmentFromCard'
```
When an attachment is deleted from a card
The event listener method receives a Trello\Event\CardAttachmentEvent instance.



```php
const CARD_EMAIL = 'emailCard'
```
When a card is shared by email
The event listener method receives a Trello\Event\CardEvent instance.



```php
const CARD_ADD_CHECKLIST = 'addChecklistToCard'
```
When a checklist is added to a card
The event listener method receives a Trello\Event\CardChecklistEvent instance.



```php
const CARD_UPDATE_CHECKLIST = 'updateChecklist'
```
When a checklist is updated on a card
The event listener method receives a Trello\Event\CardChecklistEvent instance.



```php
const CARD_REMOVE_CHECKLIST = 'removeChecklistFromCard'
```
When a checklist is removed from a card
The event listener method receives a Trello\Event\CardChecklistEvent instance.



```php
const CARD_UPDATE_CHECKLIST_ITEM_STATE = 'updateCheckItemStateOnCard'
```
When a checklist is removed from a card
The event listener method receives a Trello\Event\CardCheckItemEvent instance.



```php
const ORGANIZATION_CREATE = 'createOrganization'
```
When an organization is created
The event listener method receives a Trello\Event\OrganizationEvent instance.



```php
const ORGANIZATION_UPDATE = 'updateOrganization'
```
When an organization is updated
The event listener method receives a Trello\Event\OrganizationEvent instance.



```php
const ORGANIZATION_ADD_MEMBER = 'addMemberToOrganization'
```
When a member is added to an organization
The event listener method receives a Trello\Event\OrganizationMemberEvent instance.



```php
const ORGANIZATION_MAKE_NORMAL_MEMBER = 'makeNormalMemberOfOrganization'
```
When a member is made normal member of an organization
The event listener method receives a Trello\Event\OrganizationMemberEvent instance.



```php
const ORGANIZATION_REMOVE_ADMIN = 'removeAdminFromOrganization'
```
When a member looses admin rights of an organization
The event listener method receives a Trello\Event\OrganizationMemberEvent instance.



```php
const ORGANIZATION_DELETE_INVITATION = 'deleteOrganizationInvitation'
```
When an invitation to join an organization is deleted
The event listener method receives a Trello\Event\OrganizationMemberEvent instance.



```php
const ORGANIZATION_UNCONFIRMED_INVITATION = 'unconfirmedOrganizationInvitation'
```
When a member is invited to an organization
The event listener method receives a Trello\Event\OrganizationMemberEvent instance.



```php
const MEMBER_JOINED = 'memberJoinedTrello'
```
When a member joins
The event listener method receives a Trello\Event\MemberEvent instance.



```php
const MEMBER_UPDATE = 'updateMember'
```
When a member is updated
The event listener method receives a Trello\Event\MemberEvent instance.



```php
const POWERUP_ENABLE = 'enablePowerUp'
```
When a power up is enabled
The event listener method receives a Trello\Event\PowerUpEvent instance.



```php
const POWERUP_DISABLE = 'disablePowerUp'
```
When a power up is disabled
The event listener method receives a Trello\Event\PowerUpEvent instance.



### 
```php
all()
```

