<?php

namespace Trello\Model;

interface OrganizationInterface extends ObjectInterface
{
    /**
     * Set name
     *
     * @param string $name
     *
     * @return OrganizationInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set display name
     *
     * @param string $displayName
     *
     * @return OrganizationInterface
     */
    public function setDisplayName($displayName);

    /**
     * Get display name
     *
     * @return string
     */
    public function getDisplayName();

    /**
     * Set description
     *
     * @param string $desc
     *
     * @return OrganizationInterface
     */
    public function setDescription($desc);

    /**
     * Get desc
     *
     * @return string
     */
    public function getDesciption();

    /**
     * Set description data
     *
     * @param string $descData
     *
     * @return OrganizationInterface
     */
    public function setDescriptionData($descData);

    /**
     * Get description data
     *
     * @return string
     */
    public function getDescriptionData();

    /**
     * Set board ids
     *
     * @param array $boardIds
     *
     * @return OrganizationInterface
     */
    public function setBoardIds(array $boardIds);

    /**
     * Get board ids
     *
     * @return array
     */
    public function getBoardIds();

    /**
     * Get boards
     *
     * @return array|BoardInterface[]
     */
    public function getBoards();

    /**
     * Set invited
     *
     * @param string $invited
     *
     * @return OrganizationInterface
     */
    public function setInvited(array $invited);

    /**
     * Get invited
     *
     * @return string
     */
    public function getInvited();

    /**
     * Set invitations
     *
     * @param string $invitations
     *
     * @return OrganizationInterface
     */
    public function setInvitations(array $invitations);

    /**
     * Get invitations
     *
     * @return array
     */
    public function getInvitations();

    /**
     * Get memberships
     *
     * @return array
     */
    public function getMemberships();

    /**
     * Set preferences
     *
     * @param array $prefs
     *
     * @return OrganizationInterface
     */
    public function setPreferences(array $prefs);

    /**
     * Get preferences
     *
     * @return array
     */
    public function getPreferences();

    /**
     * Set power ups
     *
     * @param array $powerUps
     *
     * @return OrganizationInterface
     */
    public function setPowerUps(array $powerUps);

    /**
     * Get power ups
     *
     * @return array
     */
    public function getPowerUps();

    /**
     * Set products
     *
     * @param array $products
     *
     * @return OrganizationInterface
     */
    public function setProducts(array $products);

    /**
     * Get products
     *
     * @return array
     */
    public function getProducts();

    /**
     * Get billable member count
     *
     * @return integer
     */
    public function getBillableMemberCount();

    /**
     * Set url
     *
     * @param string $url
     *
     * @return OrganizationInterface
     */
    public function setUrl($url);

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl();

    /**
     * Set website
     *
     * @param string $website
     *
     * @return OrganizationInterface
     */
    public function setWebsite($website);

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite();

    /**
     * Set logo hash
     *
     * @param string $logoHash
     *
     * @return OrganizationInterface
     */
    public function setLogoHash($logoHash);

    /**
     * Get logo hash
     *
     * @return string
     */
    public function getLogoHash();

    /**
     * Set premium features
     *
     * @param array $premiumFeatures
     *
     * @return OrganizationInterface
     */
    public function setPremiumFeatures(array $premiumFeatures);

    /**
     * Get premium features
     *
     * @return array
     */
    public function getPremiumFeatures();
}
