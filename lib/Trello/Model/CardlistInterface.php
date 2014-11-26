<?php

namespace Trello\Model;

interface CardlistInterface extends ObjectInterface
{
    /**
     * Set name
     *
     * @param string $name
     *
     * @return CardInterface
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
     * @return CardInterface
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
     * @return CardInterface
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
     * @return CardInterface
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
     * @return CardInterface
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
     * @return CardInterface
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
