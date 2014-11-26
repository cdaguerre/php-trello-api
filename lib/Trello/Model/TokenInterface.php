<?php

namespace Trello\Model;

interface TokenInterface extends ObjectInterface
{
    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Get member id
     *
     * @return string
     */
    public function getMemberId();

    /**
     * Get member
     *
     * @return MemberInterface
     */
    public function getMember();

    /**
     * Get date of creation
     *
     * @return \DateTime
     */
    public function getDateOfCreation();

    /**
     * Get date of expiry
     *
     * @return \DateTime
     */
    public function getDateOfExpiry();

    /**
     * Get permissions
     *
     * @return array
     */
    public function getPermissions();

    /**
     * Get webhooks
     *
     * @return array|Webhook[]
     */
    public function getWebhooks();
}
