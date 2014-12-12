<?php

namespace Trello\Api;

/**
 * Trello Webhook API
 * @link https://trello.com/docs/api/webhook
 *
 * Not implemented:
 * - https://trello.com/docs/api/webhook/#put-1-webhooks (what is the use of this? compared to #post-1-webhooks)
 */
class Webhook extends AbstractApi
{
    /**
     * Base path of webhooks api
     * @var string
     */
    protected $path = 'webhooks';

    /**
     * Webhook fields
     * @link https://trello.com/docs/api/webhook/#get-1-webhooks-idwebhook-field
     * @var array
     */
    public static $fields = array(
        'description',
        'idModel',
        'callbackURL',
        'active',
    );

    /**
     * Find a webhook by id
     * @link https://trello.com/docs/api/webhook/#get-1-webhooks-idwebhook
     *
     * @param string $id     the webhook's id
     * @param array  $params optional attributes
     *
     * @return array
     */
    public function show($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Create a webhook
     * @link https://trello.com/docs/api/webhook/#post-1-webhooks
     *
     * @param array $params optional attributes
     *
     * @return array
     */
    public function create(array $params = array())
    {
        $this->validateRequiredParameters(array('callbackURL', 'idModel'), $params);

        return $this->post($this->getPath(), $params);
    }

    /**
     * Update a webhook
     * @link https://trello.com/docs/api/webhook/#put-1-webhooks-idwebhook
     *
     * @param string $id     the webhook's id
     * @param array  $params webhook attributes to update
     *
     * @return array
     */
    public function update($id, array $params = array())
    {
        $this->validateRequiredParameters(array('callbackURL', 'idModel'), $params);

        return $this->put($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Remove a webhook
     * @link https://trello.com/docs/api/webhook/#delete-1-webhooks-idwebhook
     *
     * @param string $id the webhook's id
     *
     * @return array
     */
    public function remove($id)
    {
        return $this->delete($this->getPath().'/'.rawurlencode($id));
    }

    /**
     * Set a given webhook's callback url
     * @link https://trello.com/docs/api/webhook/#put-1-webhooks-idwebhook-callbackurl
     *
     * @param string $id  the webhook's id
     * @param string $url the webhook's callback url
     *
     * @return array
     */
    public function setCallbackUrl($id, $url)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/callbackUrl', array('value' => $url));
    }

    /**
     * Set a given webhook's description
     * @link https://trello.com/docs/api/webhook/#put-1-webhooks-idwebhook-description
     *
     * @param string $id          the webhook's id
     * @param string $description the webhook's description
     *
     * @return array
     */
    public function setDescription($id, $description)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/description', array('value' => $description));
    }

    /**
     * Set a given webhook's board
     * @link https://trello.com/docs/api/webhook/#put-1-webhooks-idwebhook-idmodel
     *
     * @param string $id      the webhook's id
     * @param string $modelId the webhook's model id
     *
     * @return array
     */
    public function setModel($id, $modelId)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/idModel', array('value' => $modelId));
    }

    /**
     * Set a given webhook's active state
     * @link https://trello.com/docs/api/webhook/#put-1-webhooks-idwebhook-active
     *
     * @param string $id     the webhook's id
     * @param bool   $active the webhook's status
     *
     * @return array
     */
    public function setActive($id, $active)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/active', array('value' => $active));
    }
}
