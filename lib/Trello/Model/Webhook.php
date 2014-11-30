<?php

namespace Trello\Model;

/**
 * @codeCoverageIgnore
 */
class Webhook extends AbstractObject implements WebhookInterface
{
    protected $apiName = 'webhook';

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->data['description'];
    }

    /**
     * {@inheritdoc}
     */
    public function getModelId()
    {
        return $this->data['idModel'];
    }

    /**
     * {@inheritdoc}
     */
    public function getCallbackURL()
    {
        return $this->data['callbackURL'];
    }

    /**
     * {@inheritdoc}
     */
    public function isActive()
    {
        return $this->data['active'];
    }
}
