<?php

namespace Trello\Model;

interface WebhookInterface extends ObjectInterface
{
    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get modelId
     *
     * @return string
     */
    public function getModelId();

    /**
     * Get callbackURL
     *
     * @return string
     */
    public function getCallbackURL();

    /**
     * Is active?
     *
     * @return bool
     */
    public function isActive();
}
