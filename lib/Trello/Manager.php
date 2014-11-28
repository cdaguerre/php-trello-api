<?php

namespace Trello;

class Manager
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * Constructor.
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
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
