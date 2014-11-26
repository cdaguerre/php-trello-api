<?php

namespace Trello;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Trello\Exception\InvalidArgumentException;

class Service
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * Constructor.
     *
     * @param ClientInterface               $client
     * @param EventDispatcherInterface|null $dispatcher
     */
    public function __construct(ClientInterface $client, EventDispatcherInterface $dispatcher = null)
    {
        $this->client = $client;
        $this->dispatcher = $dispatcher ?: new EventDispatcher();
    }

    /**
     * Get event dispatcher
     *
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher()
    {
        return $this->dispatcher;
    }

    /**
     * Attach an event listener
     *
     * @param string $eventName @see Events for name constants
     * @param callable $listener  The listener
     * @param int      $priority  The higher this value, the earlier an event
     *                            listener will be triggered in the chain (defaults to 0)
     */
    public function on($eventName, $listener, $priority = 0)
    {
        $this->dispatcher->addListener($eventName, $listener, $priority);
    }

    /**
     * Checks whether a given request is a Trello webhook
     * and raises appropriate events @see Events
     *
     * @param Request|null $request
     */
    public function handleWebhook(Request $request = null)
    {
        if (!$request) {
            $request = Request::createFromGlobals();
        }

        if (!$this->isTrelloWebhook($request) || !$action = $request->get('action')) {
            return;
        }

        if (!isset($action['type'])) {
            throw new InvalidArgumentException('Unable to determine event from request.');
        }

        if (!isset($action['data'])) {
            throw new InvalidArgumentException('Unable to retrieve data from request.');
        }

        $eventName = $action['type'];
        $data      = $action['data'];

        switch ($eventName) {
            case Events::BOARD_CREATE:
            case Events::BOARD_UPDATE:
            case Events::BOARD_COPY:
                $event = new Event\BoardEvent();
                $event->setBoard($this->getBoard($data['board']['id']));
                break;
            case Events::BOARD_MOVE_CARD_FROM:
            case Events::BOARD_MOVE_CARD_TO:
                $event = new Event\CardMoveEvent();
                $event->setCard($this->getCard($data['card']['id']));
                break;
            case Events::BOARD_MOVE_LIST_FROM:
            case Events::BOARD_MOVE_LIST_TO:
                $event = new Event\ListMoveEvent();
                $event->setList($this->getList($data['list']['id']));
                break;
            case Events::BOARD_ADD_MEMBER:
            case Events::BOARD_MAKE_ADMIN:
            case Events::BOARD_MAKE_NORMAL_MEMBER:
            case Events::BOARD_MAKE_OBSERVER:
            case Events::BOARD_REMOVE_ADMIN:
            case Events::BOARD_DELETE_INVITATION:
            case Events::BOARD_UNCONFIRMED_INVITATION:
                $event = new Event\BoardMemberEvent();
                $event->setBoard($this->getBoard($data['board']['id']));
                $event->setMember($this->getMember($data['member']['id']));
                break;
            case Events::BOARD_ADD_TO_ORGANIZATION:
            case Events::BOARD_REMOVE_FROM_ORGANIZATION:
                $event = new Event\BoardOrganizationEvent();
                $event->setBoard($this->getBoard($data['board']['id']));
                $event->setOrganization($this->getOrganization($data['organization']['id']));
                break;
            case Events::LIST_CREATE:
            case Events::LIST_UPDATE:
            case Events::LIST_UPDATE_CLOSED:
            case Events::LIST_UPDATE_NAME:
                $event = new Event\ListEvent();
                $event->setList($this->getList($data['list']['id']));
                break;
            case Events::CARD_CREATE:
            case Events::CARD_UPDATE:
            case Events::CARD_UPDATE_LIST:
            case Events::CARD_UPDATE_NAME:
            case Events::CARD_UPDATE_DESC:
            case Events::CARD_UPDATE_CLOSED:
            case Events::CARD_DELETE:
            case Events::CARD_EMAIL:
                $event = new Event\CardEvent();
                $event->setCard($this->getCard($data['card']['id']));
                break;
            case Events::CARD_COPY:
                $event = new Event\CardCopyEvent();
                $event->setCard($this->getCard($data['card']['id']));
                break;
            case Events::CARD_ADD_MEMBER:
            case Events::CARD_REMOVE_MEMBER:
                $event = new Event\CardMemberEvent();
                $event->setCard($this->getCard($data['card']['id']));
                $event->setMember($this->getMember($data['member']['id']));
                break;
            case Events::CARD_COMMENT:
            case Events::CARD_COPY_COMMENT:
                $event = new Event\CardCommentEvent();
                $event->setCard($this->getCard($data['card']['id']));
                $event->setComment($data['text']);
                break;
            case Events::CARD_FROM_CHECKITEM:
                $event = new Event\CardFromCheckItemEvent();
                $event->setCard($this->getCard($data['card']['id']));
                break;
            case Events::CARD_ADD_ATTACHMENT:
            case Events::CARD_DELETE_ATTACHMENT:
                $event = new Event\CardAttachmentEvent();
                $event->setCard($this->getCard($data['card']['id']));
                $event->setAttachment($data['attachment']);
                break;
            case Events::CARD_ADD_CHECKLIST:
            case Events::CARD_UPDATE_CHECKLIST:
            case Events::CARD_REMOVE_CHECKLIST:
            case Events::CARD_UPDATE_CHECKLIST_ITEM_STATE:
                $event = new Event\CardChecklistEvent();
                $event->setCard($this->getCard($data['card']['id']));
                $event->setChecklist($this->getChecklist($data['checklist']['id']));
                break;
            case Events::ORGANIZATION_CREATE:
            case Events::ORGANIZATION_UPDATE:
                $event = new Event\OrganizationEvent();
                $event->setOrganization($this->getOrganization($data['organization']['id']));
                break;
            case Events::ORGANIZATION_ADD_MEMBER:
            case Events::ORGANIZATION_MAKE_NORMAL_MEMBER:
            case Events::ORGANIZATION_REMOVE_ADMIN:
            case Events::ORGANIZATION_DELETE_INVITATION:
            case Events::ORGANIZATION_UNCONFIRMED_INVITATION:
                $event = new Event\OrganizationMemberEvent();
                $event->setOrganization($this->getOrganization($data['organization']['id']));
                $event->setMember($this->getMember($data['member']['id']));
                break;
            case Events::MEMBER_JOINED:
            case Events::MEMBER_UPDATE:
                $event = new Event\MemberEvent();
                $event->setMember($this->getMember($data['member']['id']));
                break;
            case Events::POWERUP_ENABLE:
            case Events::POWERUP_DISABLE:
                $event = new Event\PowerUpEvent();
                $event->setPowerUp($data['powerUp']);
                break;
            default:
                throw new InvalidArgumentException(sprintf(
                    'Unknown event "%s" occured with following data: "%s".',
                    $eventName,
                    serialize($data)
                ));
        }

        $this->dispatcher->dispatch($eventName, $event);
    }

    /**
     * Checks whether a given request is a Trello webhook
     *
     * @param Request $request
     *
     * @return bool
     */
    public function isTrelloWebhook(Request $request)
    {
        if (!$request->headers->has('X-Trello-Webhook')) {
            return false;
        }

        return true;
    }

    /**
     * Get organization by id or create a new one
     *
     * @param string $id the organization's id
     *
     * @return Model\OrganizationInterface
     */
    public function getOrganization($id = null)
    {
        return new Model\Organization($this->client, $id);
    }

    /**
     * Get board by id or create a new one
     *
     * @param string $id the board's id
     *
     * @return Model\BoardInterface
     */
    public function getBoard($id = null)
    {
        return new Model\Board($this->client, $id);
    }

    /**
     * Get cardlist by id or create a new one
     *
     * @param string $id the cardlist's id
     *
     * @return Model\CardlistInterface
     */
    public function getList($id = null)
    {
        return new Model\Cardlist($this->client, $id);
    }

    /**
     * Get card by id or create a new one
     *
     * @param string $id the card's id
     *
     * @return Model\CardInterface
     */
    public function getCard($id = null)
    {
        return new Model\Card($this->client, $id);
    }

    /**
     * Get checklist by id or create a new one
     *
     * @param string $id the checklist's id
     *
     * @return Model\ChecklistInterface
     */
    public function getChecklist($id = null)
    {
        return new Model\Checklist($this->client, $id);
    }

    /**
     * Get member by id or create a new one
     *
     * @param string $id the member's id
     *
     * @return Model\MemberInterface
     */
    public function getMember($id = null)
    {
        return new Model\Member($this->client, $id);
    }

    /**
     * Get action by id
     *
     * @param string $id the action's id
     *
     * @return Model\ActionInterface
     */
    public function getAction($id)
    {
        return new Model\Action($this->client, $id);
    }

    /**
     * Get token by id
     *
     * @param string $id the token's id
     *
     * @return Model\TokenInterface
     */
    public function getToken($id)
    {
        return new Model\Token($this->client, $id);
    }

    /**
     * Get webhook by id
     *
     * @param string $id the webhook's id
     *
     * @return Model\WebhookInterface
     */
    public function getWebhook($id)
    {
        return new Model\Webhook($this->client, $id);
    }
}
