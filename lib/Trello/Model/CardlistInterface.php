<?php

namespace Trello\Model;

interface CardlistInterface extends ObjectInterface
{
    /**
     * Set name
     *
     * @param string $name
     *
     * @return CardlistInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set boardId
     *
     * @param string $boardId
     *
     * @return CardlistInterface
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
     * @return CardlistInterface
     */
    public function setBoard(BoardInterface $board);

    /**
     * Get board
     *
     * @return BoardInterface
     */
    public function getBoard();

    /**
     * Set position
     *
     * @param string $pos
     *
     * @return CardlistInterface
     */
    public function setPosition($pos);

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition();

    /**
     * Set closed
     *
     * @param bool $closed
     *
     * @return CardlistInterface
     */
    public function setClosed($closed);

    /**
     * Get closed
     *
     * @return bool
     */
    public function isClosed();

    /**
     * Set subscribed
     *
     * @param bool $subscribed
     *
     * @return CardlistInterface
     */
    public function setSubscribed($subscribed);

    /**
     * Get subscribed
     *
     * @return bool
     */
    public function isSubscribed();

    /**
     * Get cards
     *
     * @return array|CardInterface[]
     */
    public function getCards();
}
