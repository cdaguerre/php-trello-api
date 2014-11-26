<?php

namespace Trello\Model;

interface MemberInterface extends ObjectInterface
{
    /**
     * Set avatar hash
     *
     * @param $avatarHash
     *
     * @return MemberInterface
     */
    public function setAvatarHash($avatarHash);

    /**
     * Get avatar hash
     *
     * @return string
     */
    public function getAvatarHash();

    /**
     * Set bio
     *
     * @param string $bio
     *
     * @return MemberInterface
     */
    public function setBio($bio);

    /**
     * Get bio
     *
     * @return string
     */
    public function getBio();

    /**
     * Get bio data
     *
     * @return string
     */
    public function getBioData();

    /**
     * Set confirmed
     *
     * @param bool $confirmed
     *
     * @return MemberInterface
     */
    public function setConfirmed($confirmed);

    /**
     * Is confirmed
     *
     * @return bool
     */
    public function isConfirmed();

    /**
     * Set full name
     *
     * @param string $fullName
     *
     * @return MemberInterface
     */
    public function setFullName($fullName);

    /**
     * Get full name
     *
     * @return string
     */
    public function getFullName();

    /**
     * Set id prem orgs admin
     *
     * @param array $idPremOrgsAdmin
     *
     * @return MemberInterface
     */
    public function setIdPremOrgsAdmin(array $idPremOrgsAdmin);

    /**
     * Get idPremOrgsAdmin
     *
     * @return array
     */
    public function getIdPremOrgsAdmin();

    /**
     * Set Initials
     *
     * @param string $initials
     *
     * @return MemberInterface
     */
    public function setInitials($initials);

    /**
     * Get initials
     *
     * @return string
     */
    public function getInitials();

    /**
     * Set MemberType
     *
     * @param string $memberType
     *
     * @return MemberInterface
     */
    public function setMemberType($memberType);

    /**
     * Get member type
     *
     * @return string
     */
    public function getMemberType();

    /**
     * Set products
     *
     * @param array $products
     *
     * @return MemberInterface
     */
    public function setProducts(array $products);

    /**
     * Get products
     *
     * @return string
     */
    public function getProducts();

    /**
     * Set status
     *
     * @param string $status
     *
     * @return MemberInterface
     */
    public function setStatus($status);

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus();

    /**
     * Set url
     *
     * @param string $url
     *
     * @return MemberInterface
     */
    public function setUrl($url);

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl();

    /**
     * Set username
     *
     * @param string $username
     *
     * @return MemberInterface
     */
    public function setUsername($username);

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set avatar source
     *
     * @param string $avatarSource
     *
     * @return MemberInterface
     */
    public function setAvatarSource($avatarSource);

    /**
     * Get avatar source
     *
     * @return string
     */
    public function getAvatarSource();

    /**
     * Set email
     *
     * @param string $email
     *
     * @return MemberInterface
     */
    public function setEmail($email);

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set gravatar hash
     *
     * @param $gravatarHash
     *
     * @return MemberInterface
     */
    public function setGravatarHash($gravatarHash);

    /**
     * Get gravatar hash
     *
     * @return string
     */
    public function getGravatarHash();

    /**
     * Set board ids
     *
     * @param array $boardIds
     *
     * @return MemberInterface
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
     * Set pinned board ids
     *
     * @param array $pinnedBoardIds
     *
     * @return MemberInterface
     */
    public function setPinnedBoardIds(array $pinnedBoardIds);

    /**
     * Get pinned board ids
     *
     * @return array
     */
    public function getPinnedBoardIds();

    /**
     * Get pinnedBoards
     *
     * @return array|BoardInterface[]
     */
    public function getPinnedBoards();

    /**
     * Set organization ids
     *
     * @param array $organizationIds
     *
     * @return MemberInterface
     */
    public function setOrganizationIds(array $organizationIds);

    /**
     * Get organization ids
     *
     * @return array
     */
    public function getOrganizationIds();

    /**
     * Get organizations
     *
     * @return array\OrganizationInterface[]
     */
    public function getOrganizations();

    /**
     * Set login types
     *
     * @param array $loginTypes
     *
     * @return MemberInterface
     */
    public function setLoginTypes($loginTypes);

    /**
     * Get login types
     *
     * @return array
     */
    public function getLoginTypes();

    /**
     * Set new email
     *
     * @param string $newEmail
     *
     * @return MemberInterface
     */
    public function setNewEmail($newEmail);

    /**
     * Set one time messages dismissed
     *
     * @param array $messages
     *
     * @return MemberInterface
     */
    public function setOneTimeMessagesDismissed(array $messages);

    /**
     * Get one time messages dismissed
     *
     * @return array
     */
    public function getOneTimeMessagesDismissed();

    /**
     * Set preferences
     *
     * @param array $prefs
     *
     * @return MemberInterface
     */
    public function setPreferences(array $prefs);

    /**
     * Get preferences
     *
     * @return array
     */
    public function getPreferences();

    /**
     * Set trophies
     *
     * @param array $trophies
     *
     * @return MemberInterface
     */
    public function setTrophies(array $trophies);

    /**
     * Get trophies
     *
     * @return array
     */
    public function getTrophies();

    /**
     * Set uploaded avatar hash
     *
     * @param string $uploadedAvatarHash
     *
     * @return MemberInterface
     */
    public function setUploadedAvatarHash($uploadedAvatarHash);

    /**
     * Get uploaded avatar hash
     *
     * @return string
     */
    public function getUploadedAvatarHash();

    /**
     * Set premium features
     *
     * @param array $features
     *
     * @return MemberInterface
     */
    public function setPremiumFeatures(array $features);

    /**
     * Get premiumFeatures
     *
     * @return array
     */
    public function getPremiumFeatures();
}
