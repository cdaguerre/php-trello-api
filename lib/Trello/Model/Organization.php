<?php

namespace Trello\Model;

/**
 * @codeCoverageIgnore
 */
class Organization extends AbstractObject implements OrganizationInterface
{
    protected $apiName = 'organization';

    protected $loadParams = array(
        'fields' => 'all',
        'members' => 'all',
        'membersInvited' => 'all',
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
    public function setDisplayName($displayName)
    {
        $this->data['displayName'] = $displayName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDisplayName()
    {
        return $this->data['displayName'];
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($desc)
    {
        $this->data['desc'] = $desc;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDesciption()
    {
        return $this->data['desc'];
    }

    /**
     * {@inheritdoc}
     */
    public function setDescriptionData($descData)
    {
        $this->data['descData'] = $descData;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescriptionData()
    {
        return $this->data['descData'];
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
    public function setInvited(array $invited)
    {
        $this->data['invited'] = $invited;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getInvited()
    {
        return $this->data['invited'];
    }

    /**
     * {@inheritdoc}
     */
    public function setInvitations(array $invitations)
    {
        $this->data['invitations'] = $invitations;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getInvitations()
    {
        return $this->data['invitations'];
    }

    /**
     * {@inheritdoc}
     */
    public function getMemberships()
    {
        return $this->data['memberships'];
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
    public function setPowerUps(array $powerUps)
    {
        $this->data['powerUps'] = $powerUps;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPowerUps()
    {
        return $this->data['powerUps'];
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
    public function getBillableMemberCount()
    {
        return $this->data['billableMemberCount'];
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
    public function setWebsite($website)
    {
        $this->data['website'] = $website;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getWebsite()
    {
        return $this->data['website'];
    }

    /**
     * {@inheritdoc}
     */
    public function setLogoHash($logoHash)
    {
        $this->data['logoHash'] = $logoHash;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLogoHash()
    {
        return $this->data['logoHash'];
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
