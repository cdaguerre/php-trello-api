<?php

namespace Trello\Model;



class Label extends AbstractObject implements LabelInterface
{
    protected $apiName = 'label';

    protected $loadParams = array(
        'fields'    => 'all',
        'board'     => true,
    );

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->data['id'];
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
    public function setColor($color)
    {
        $this->data['color'] = $color;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getColor()
    {
        return $this->data['color'];
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
}
