<?php

namespace Trello\Model;

use Trello\Exception\InvalidArgumentException;
use Trello\ClientInterface;

/**
 * @codeCoverageIgnore
 */
class Checklist extends AbstractObject implements ChecklistInterface
{
    protected $apiName = 'checklist';

    protected $loadParams = array(
        'fields' => 'all',
        'checkItems' => 'all',
        'checkItem_fields' => 'all',
    );

    protected $itemsToBeRemoved = array();

    public function __construct(ClientInterface $client, $id = null)
    {
        $this->data = array(
            'name' => null,
            'checkItems' => array(),
        );

        parent::__construct($client, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->data['name'] = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->data['name'];
    }

    /**
     * {@inheritdoc}
     */
    public function setBoardId($boardId)
    {
        $this->data['idBoard'] = $boardId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBoardId()
    {
        return $this->data['idBoard'];
    }

    /**
     * {@inheritdoc}
     */
    public function setBoard(BoardInterface $board)
    {
        return $this->setBoardId($board->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function getBoard()
    {
        return new Board($this->client, $this->getBoardId());
    }

    /**
     * {@inheritdoc}
     */
    public function setCardId($cardId)
    {
        $this->data['idCard'] = $cardId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCardId()
    {
        return $this->data['idCard'];
    }

    /**
     * {@inheritdoc}
     */
    public function setCard(CardInterface $card)
    {
        return $this->setCardId($card->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function getCard()
    {
        return new Card($this->client, $this->getCardId());
    }

    /**
     * {@inheritdoc}
     */
    public function setPosition($pos)
    {
        $this->data['pos'] = $pos;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition()
    {
        return $this->data['pos'];
    }

    /**
     * {@inheritdoc}
     */
    public function getItems()
    {
        return $this->data['checkItems'];
    }

    /**
     * {@inheritdoc}
     * @param string $nameOrId
     */
    public function hasItem($nameOrId)
    {
        foreach ($this->getItems() as $item) {
            if ($item['name'] === $nameOrId || (isset($item['id']) && $item['id'] === $nameOrId)) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getItemKey($nameOrId)
    {
        foreach ($this->getItems() as $key => $item) {
            if ($item['name'] === $nameOrId || (isset($item['id']) && $item['id'] === $nameOrId)) {
                return $key;
            }
        }

        throw new InvalidArgumentException(sprintf(
            'Checklist "%s" does not have an item with name or id "%s"',
            $this->getName(),
            $nameOrId
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function removeItem($nameOrId)
    {
        $key = $this->getItemKey($nameOrId);

        if (isset($this->data['checkItems'][$key]['id'])) {
            $this->itemsToBeRemoved[] = $this->data['checkItems'][$key]['id'];
        }

        unset($this->data['checkItems'][$key]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setItem($nameOrId, $checked = null, $position = null)
    {
        if ($this->hasItem($nameOrId)) {
            $key = $this->getItemKey($nameOrId);

            $this->data['checkItems'][$key]['state'] = $checked;

            if (isset($position)) {
                $this->data['checkItems'][$key]['position'] = $position;
            }
        } else {
            $this->data['checkItems'][] = array(
                'name'     => $nameOrId,
                'state'    => $checked,
                'position' => $position,
            );
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setItemChecked($nameOrId, $bool)
    {
        $key = $this->getItemKey($nameOrId);
        $this->data['checkItems'][$key]['state'] = $bool;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isItemChecked($nameOrId)
    {
        $key = $this->getItemKey($nameOrId);

        return $this->data['checkItems'][$key]['state'];
    }

    /**
     * {@inheritdoc}
     */
    protected function postRefresh()
    {
        foreach ($this->data['checkItems'] as $key => $item) {
            $this->data['checkItems'][$key]['state'] = in_array($item['state'], array(true, 'complete', 'true'));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function preSave()
    {
        $items = $this->data['checkItems'];

        if (!$this->id) {
            $this->create();
        }

        foreach ($this->itemsToBeRemoved as $itemId) {
            $this->api->items()->remove($this->id, $itemId);
        }
        foreach ($items as $item) {
            if (isset($item['id'])) {
                $this->api->items()->update($this->id, $item['id'], $item);
            } else {
                $this->api->items()->create($this->id, $item['name'], $item['state'], $item);
            }
        }
    }
}
