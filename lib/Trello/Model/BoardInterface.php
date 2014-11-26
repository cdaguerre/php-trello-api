<?php

namespace Trello\Model;

interface BoardInterface extends ObjectInterface
{
    /**
     * Set name
     *
     * @param string $name a string with a length from 1 to 16384
     *
     * @return BoardInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set description
     *
     * @param string $desc a string with a length from 0 to 16384
     *
     * @return BoardInterface
     */
    public function setDescription($desc);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get description data
     *
     * @return string
     */
    public function getDescriptionData();

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl();

    /**
     * Get short url
     *
     * @return string
     */
    public function getShortUrl();

    /**
     * Get short link
     *
     * @return string
     */
    public function getShortLink();

    /**
     * Set organization id
     *
     * @param string $organizationId the organization'is id, ie. a string with a length from 0 to 16384
     *
     * @return BoardInterface
     */
    public function setOrganizationId($organizationId);

    /**
     * Get organization id
     *
     * @return string
     */
    public function getOrganizationId();

    /**
     * Set organization
     *
     * @param OrganizationInterface $organization
     *
     * @return BoardInterface
     */
    public function setOrganization(OrganizationInterface $organization);

    /**
     * Get organization
     *
     * @return OrganizationInterface
     */
    public function getOrganization();

    /**
     * Get lists
     *
     * @return CardlistInterface[]
     */
    public function getLists();

    /**
     * Set closed
     *
     * @param bool $closed
     *
     * @return BoardInterface
     */
    public function setClosed($closed);

    /**
     * Get closed
     *
     * @return bool
     */
    public function isClosed();

    /**
     * Set pinned
     *
     * @param bool $pinned
     *
     * @return BoardInterface
     */
    public function setPinned($pinned);

    /**
     * Get pinned
     *
     * @return bool
     */
    public function isPinned();

    /**
     * Set starred
     *
     * @param bool $starred
     *
     * @return BoardInterface
     */
    public function setStarred($starred);

    /**
     * Get starred
     *
     * @return bool
     */
    public function isStarred();

    /**
     * Set subscribed
     *
     * @param bool $subscribed
     *
     * @return BoardInterface
     */
    public function setSubscribed($subscribed);

    /**
     * Get subscribed
     *
     * @return bool
     */
    public function isSubscribed();

    /**
     * Get invited
     *
     * @return bool
     */
    public function isInvited();

    /**
     * Set the role required to invite
     *
     * @param string $role one of 'members', 'admins'
     *
     * @return BoardInterface
     */
    public function setRequiredRoleToInvite($role);

    /**
     * Get the role required to invite
     *
     * @return string
     */
    public function getRequiredRoleToInvite();

    /**
     * Set memberships
     *
     * @param array $memberships an array of arrays containing:
     *                           - idMembership: a member id
     *                           - type: one of 'normal', 'observer', 'admin'
     *                           - member_fields (optional)
     *
     * @return BoardInterface
     */
    public function setMemberships(array $memberships);

    /**
     * Get memberships
     *
     * @return array
     */
    public function getMemberships();

    /**
     * Set prefs
     *
     * @param array $prefs a preferences array that may contain the following keys:
     *                     - permissionLevel: 'private', 'org', 'public'
     *                     - selfJoin: 'true', 'false'
     *                     - cardCovers: 'true', 'false'
     *                     - invitations: 'members', 'admins'
     *                     - voting: 'members', 'org', 'public', 'disabled', 'observers'
     *                     - comments: 'members', 'org', 'public', 'disabled', 'observers'
     *                     - background: a standard background name, or the id of a custom background
     *                     - cardAging: 'regular', 'pirate'
     *                     - calendarFeedEnabled: 'true', 'false'
     *
     * @return BoardInterface
     */
    public function setPreferences(array $prefs);

    /**
     * Get prefs
     *
     * @return string
     */
    public function getPreferences();

    /**
     * Set label names
     *
     * @param array $labelNames an array of 'color' => 'label name'
     *                          existing colors are: 'green', 'yellow', 'orange', 'red', 'purple', 'blue'
     *
     * @return BoardInterface
     */
    public function setLabelNames(array $labelNames);

    /**
     * Get label names
     *
     * @return array
     */
    public function getLabelNames();

    /**
     * Set power ups
     *
     * @param array $powerUps an array of 'voting', 'cardAging', 'calendar', 'recap'
     *
     * @return BoardInterface
     */
    public function setPowerUps(array $powerUps);

    /**
     * Get power ups
     *
     * @return array
     */
    public function getPowerUps();

    /**
     * Get date last activity
     *
     * @return \DateTime
     */
    public function getDateOfLastActivity();

    /**
     * Get date of last view
     *
     * @return \DateTime
     */
    public function getDateOfLastView();
}
