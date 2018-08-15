<?php

namespace Trello\Model;

interface LabelInterface extends ObjectInterface
{
    /**
     * Get id
     *
     * @return string
     */
    public function getId();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return LabelInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @param string $name
     *
     * @return LabelInterface
     */
    public function getName();

    /**
     * Set color
     *
     * @param string $color
     *
     * @return LabelInterface
     */
    public function setColor($color);

    /**
     * Get color
     *
     * @param string $color
     *
     * @return LabelInterface
     */
    public function getColor();

    /**
     * Set boardId
     *
     * @param string $boardId
     *
     * @return LabelInterface
     */
    public function setBoardId($boardId);

    /**
     * Get boardId
     *
     * @return string
     */
    public function getBoardId();

    /**
     * Set board
     *
     * @param BoardInterface $board
     *
     * @return LabelInterface
     */
    public function setBoard(BoardInterface $board);

    /**
     * Get board
     *
     * @return BoardInterface
     */
    public function getBoard();


}
