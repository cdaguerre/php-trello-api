<?php

namespace Trello\Model;

use Trello\ClientInterface;
use Trello\Api\ApiInterface;
use Trello\Exception\BadMethodCallException;

/**
 * @codeCoverageIgnore
 */
abstract class AbstractObject
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $apiName;

    /**
     * @var ApiInterface
     */
    protected $api;

    /**
     * @var array
     */
    protected $fields;

    /**
     * Default load params, should be overwritten
     * in child classes
     *
     * @var array
     */
    protected $loadParams = array('fields' => 'all');

    /**
     * @var string
     */
    protected $id;

    /**
     * @var array
     */
    protected $data;

    /**
     * Constructor.
     *
     * @param ClientInterface $client the Trello client
     * @param string          $id     the id of the object
     */
    public function __construct(ClientInterface $client, $id = null)
    {
        $this->client = $client;
        $this->api    = $client->api($this->apiName);

        $this->fields = $this->api->getFields();

        if ($id) {
            $this->id = $id;
            $this->refresh();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function refresh()
    {
        $this->preRefresh();
        $this->data = $this->api->show($this->id, $this->loadParams);
        $this->postRefresh();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
        try {
            $this->preSave();
            $this->id ? $this->update() : $this->create();
            $this->postSave();
        } catch (BadMethodCallException $e) {
            throw new BadMethodCallException(sprintf(
                "You can't %s %s objects.",
                $this->id ? 'update' : 'create',
                get_called_class()
            ));
        }

        return $this->refresh();
    }

    /**
     * {@inheritdoc}
     */
    public function remove()
    {
        try {
            $this->preRemove();
            $this->api->remove($this->id);
            $this->postRemove();
        } catch (BadMethodCallException $e) {
            throw new BadMethodCallException(sprintf(
                "You can't remove %s objects.",
                get_called_class()
            ));
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Update the object through API
     *
     * @return AbstractObject
     */
    protected function update()
    {
        $this->preUpdate();
        $this->data = $this->api->update($this->id, $this->data);
        $this->postUpdate();

        return $this;
    }

    /**
     * Create the object through API
     *
     * @return AbstractObject
     */
    protected function create()
    {
        $this->preCreate();
        $this->data = $this->api->create($this->data);
        $this->id   = $this->data['id'];
        $this->postCreate();

        return $this;
    }

    /**
     * Called before saving (creating or updating) an entity
     */
    protected function preSave()
    {
    }

    /**
     * Called after saving (creating or updating) an entity
     */
    protected function postSave()
    {
    }

    /**
     * Called before creating an entity
     */
    protected function preCreate()
    {
    }

    /**
     * Called after creating an entity
     */
    protected function postCreate()
    {
    }

    /**
     * Called before updating an entity
     */
    protected function preUpdate()
    {
    }

    /**
     * Called after updating an entity
     */
    protected function postUpdate()
    {
    }

    /**
     * Called before refreshing an entity
     */
    protected function preRefresh()
    {
    }

    /**
     * Called after refreshing an entity
     */
    protected function postRefresh()
    {
    }

    /**
     * Called before removing an entity
     */
    protected function preRemove()
    {
    }

    /**
     * Called after removing an entity
     */
    protected function postRemove()
    {
    }
}
