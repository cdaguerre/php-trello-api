<?php

namespace Trello\Model;

/**
 * @codeCoverageIgnore
 */
class Checklist extends AbstractObject implements ChecklistInterface
{
    protected $apiName = 'checklist';

    protected $loadParams = array(
        'fields' => 'all',
    );

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
     */
    public function setItem($name, $checked = null, $position = null)
    {
        foreach ($this->data['checkItems'] as $key => $item) {
            if ($item['name'] === $name) {
                $this->data['checkItems'][$key]['state'] = $checked ? 'complete' : 'incomplete';
                if (isset($position)) {
                    $this->data['checkItems'][$key]['position'] = $position;
                }

                return $this;
            }
        }

        $this->data['checkItems'][] = array(
            'name' => $name,
            'state' => $checked ? 'complete' : 'incomplete',
            'position' => $position,
        );

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isItemChecked($name)
    {
        foreach ($this->data['checkItems'] as $item) {
            if ($item['name'] === $name) {
                return $item['state'] === 'complete';
            }
        }
    }
}
