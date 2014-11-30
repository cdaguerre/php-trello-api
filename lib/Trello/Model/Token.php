<?php

namespace Trello\Model;

/**
 * @codeCoverageIgnore
 */
class Token extends AbstractObject implements TokenInterface
{
    protected $apiName = 'token';

    protected $loadParams = array(
        'fields' => 'all',
        'webhooks' => true,
    );

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return $this->data['identifier'];
    }

    /**
     * {@inheritdoc}
     */
    public function getMemberId()
    {
        return $this->data['idMember'];
    }

    /**
     * {@inheritdoc}
     */
    public function getMember()
    {
        return new Member($this->client, $this->data['idMember']);
    }

    /**
     * {@inheritdoc}
     */
    public function getDateOfCreation()
    {
        return new \DateTime($this->data['dateCreated']);
    }

    /**
     * {@inheritdoc}
     */
    public function getDateOfExpiry()
    {
        return new \DateTime($this->data['dateExpires']);
    }

    /**
     * {@inheritdoc}
     */
    public function getPermissions()
    {
        return $this->data['permissions'];
    }

    /**
     * {@inheritdoc}
     */
    public function getWebhooks()
    {
        $webhooks = array();

        foreach ($this->data['webhooks'] as $webhook) {
            $webhooks[] = new Webhook($this->client, $webhook['id']);
        }

        return $webhooks;
    }
}
