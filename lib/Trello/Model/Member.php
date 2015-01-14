<?php

namespace Trello\Model;

use Trello\Exception\InvalidArgumentException;

/**
 * @codeCoverageIgnore
 */
class Member extends AbstractObject implements MemberInterface
{
    protected $apiName = 'member';

    protected $loadParams = array(
        'fields' => 'all',
    );

    /**
     * {@inheritdoc}
     */
    public function setAvatarHash($avatarHash)
    {
        $this->data['avatarHash'] = $avatarHash;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAvatarHash()
    {
        return $this->data['avatarHash'];
    }

    /**
     * {@inheritdoc}
     */
    public function setBio($bio)
    {
        $this->data['bio'] = $bio;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBio()
    {
        return $this->data['bio'];
    }

    /**
     * {@inheritdoc}
     */
    public function getBioData()
    {
        return $this->data['bioData'];
    }

    /**
     * {@inheritdoc}
     */
    public function setConfirmed($confirmed)
    {
        $this->data['confirmed'] = $confirmed;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isConfirmed()
    {
        return $this->data['confirmed'];
    }

    /**
     * {@inheritdoc}
     */
    public function setFullName($fullName)
    {
        $this->data['fullName'] = $fullName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFullName()
    {
        return $this->data['fullName'];
    }

    /**
     * {@inheritdoc}
     */
    public function setIdPremOrgsAdmin(array $idPremOrgsAdmin)
    {
        $this->data['idPremOrgsAdmin'] = $idPremOrgsAdmin;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getIdPremOrgsAdmin()
    {
        return $this->data['idPremOrgsAdmin'];
    }

    /**
     * {@inheritdoc}
     */
    public function setInitials($initials)
    {
        $this->data['initials'] = $initials;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getInitials()
    {
        return $this->data['initials'];
    }

    /**
     * {@inheritdoc}
     */
    public function setMemberType($memberType)
    {
        if (!in_array($memberType, array('admin', 'normal', 'observer'))) {
            throw new InvalidArgumentException(sprintf(
                'The member type %s does not exist.',
                $memberType
            ));
        }

        $this->data['memberType'] = $memberType;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMemberType()
    {
        return $this->data['memberType'];
    }

    /**
     * {@inheritdoc}
     */
    public function setProducts(array $products)
    {
        $this->data['products'] = $products;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getProducts()
    {
        return $this->data['products'];
    }

    /**
     * {@inheritdoc}
     */
    public function setStatus($status)
    {
        $this->data['status'] = $status;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return $this->data['status'];
    }

    /**
     * {@inheritdoc}
     */
    public function setUrl($url)
    {
        $this->data['url'] = $url;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        return $this->data['url'];
    }

    /**
     * {@inheritdoc}
     */
    public function setUsername($username)
    {
        $this->data['username'] = $username;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->data['username'];
    }

    /**
     * {@inheritdoc}
     */
    public function setAvatarSource($avatarSource)
    {
        $this->data['avatarSource'] = $avatarSource;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAvatarSource()
    {
        return $this->data['avatarSource'];
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail($email)
    {
        $this->data['email'] = $email;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->data['email'];
    }

    /**
     * {@inheritdoc}
     */
    public function setGravatarHash($gravatarHash)
    {
        $this->data['gravatarHash'] = $gravatarHash;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getGravatarHash()
    {
        return $this->data['gravatarHash'];
    }

    /**
     * {@inheritdoc}
     */
    public function setBoardIds(array $boardIds)
    {
        $this->data['idBoards'] = $boardIds;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBoardIds()
    {
        return $this->data['idBoards'];
    }

    /**
     * {@inheritdoc}
     */
    public function getBoards()
    {
        $boards = array();

        foreach ($this->data['idBoards'] as $boardId) {
            $boards[] = new Board($this->client, $boardId);
        }

        return $boards;
    }

    /**
     * {@inheritdoc}
     */
    public function setPinnedBoardIds(array $pinnedBoardIds)
    {
        $this->data['idBoardsPinned'] = $pinnedBoardIds;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPinnedBoardIds()
    {
        return $this->data['idBoardsPinned'];
    }

    /**
     * {@inheritdoc}
     */
    public function getPinnedBoards()
    {
        $boards = array();

        foreach ($this->data['idBoardsPinned'] as $boardId) {
            $boards[] = new Board($this->client, $boardId);
        }

        return $boards;
    }

    /**
     * {@inheritdoc}
     */
    public function setOrganizationIds(array $organizationIds)
    {
        $this->data['idOrganizations'] = $organizationIds;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrganizationIds()
    {
        return $this->data['idOrganizations'];
    }

    /**
     * {@inheritdoc}
     */
    public function getOrganizations()
    {
        $organizations = array();

        foreach ($this->data['idOrganizations'] as $organizationId) {
            $organizations[] = new Organization($this->client, $organizationId);
        }

        return $organizations;
    }

    /**
     * {@inheritdoc}
     */
    public function setLoginTypes($loginTypes)
    {
        $this->data['loginTypes'] = $loginTypes;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLoginTypes()
    {
        return $this->data['loginTypes'];
    }

    /**
     * {@inheritdoc}
     */
    public function setNewEmail($newEmail)
    {
        $this->data['newEmail'] = $newEmail;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setOneTimeMessagesDismissed(array $messages)
    {
        $this->data['oneTimeMessagesDismissed'] = $messages;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOneTimeMessagesDismissed()
    {
        return $this->data['oneTimeMessagesDismissed'];
    }

    /**
     * {@inheritdoc}
     */
    public function setPreferences(array $prefs)
    {
        $this->data['prefs'] = $prefs;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPreferences()
    {
        return $this->data['prefs'];
    }

    /**
     * {@inheritdoc}
     */
    public function setTrophies(array $trophies)
    {
        $this->data['trophies'] = $trophies;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTrophies()
    {
        return $this->data['trophies'];
    }

    /**
     * {@inheritdoc}
     */
    public function setUploadedAvatarHash($uploadedAvatarHash)
    {
        $this->data['uploadedAvatarHash'] = $uploadedAvatarHash;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUploadedAvatarHash()
    {
        return $this->data['uploadedAvatarHash'];
    }

    /**
     * {@inheritdoc}
     */
    public function setPremiumFeatures(array $premiumFeatures)
    {
        $this->data['premiumFeatures'] = $premiumFeatures;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPremiumFeatures()
    {
        return $this->data['premiumFeatures'];
    }
}
