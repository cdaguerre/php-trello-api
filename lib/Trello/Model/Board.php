<?php

namespace Trello\Model;

use Trello\Exception\InvalidArgumentException;

/**
 * @codeCoverageIgnore
 */
class Board extends AbstractObject implements BoardInterface
{
    protected $apiName = 'board';

    protected $loadParams = array(
        'fields'                   => 'all',
        'organization'             => true,
        'organization_memberships' => 'all',
        'members'                  => 'all',
        'membersInvited'           => 'all',
        'memberships'              => 'all',
        'lists'                    => 'all',
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
    public function setDescription($desc)
    {
        $this->data['desc'] = $desc;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->data['desc'];
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
    public function getUrl()
    {
        return $this->data['url'];
    }

    /**
     * {@inheritdoc}
     */
    public function getShortUrl()
    {
        return $this->data['shortUrl'];
    }

    /**
     * {@inheritdoc}
     */
    public function getShortLink()
    {
        return $this->data['shortLink'];
    }

    /**
     * {@inheritdoc}
     */
    public function setOrganizationId($organizationId)
    {
        $this->data['idOrganization'] = $organizationId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrganizationId()
    {
        return $this->data['idOrganization'];
    }

    /**
     * {@inheritdoc}
     */
    public function setOrganization(OrganizationInterface $organization)
    {
        return $this->setOrganizationId($organization->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function getOrganization()
    {
        return new Organization($this->client, $this->getOrganizationId());
    }

    /**
     * {@inheritdoc}
     */
    public function getLists()
    {
        $lists = array();

        foreach ($this->data['lists'] as $data) {
            $lists[$data['id']] = new Cardlist($this->client, $data['id']);
        }

        return $lists;
    }

    /**
     * {@inheritdoc}
     */
    public function getList($idOrName)
    {
        foreach ($this->getLists() as $list) {
            if ($list->getName() === $idOrName || $list->getId() === $idOrName) {
                return $list;
            }
        }

        throw new InvalidArgumentException(sprintf(
            'There is no list with name or id "%s" on this board ("%s")',
            $idOrName,
            $this->getName()
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setClosed($closed)
    {
        $this->data['closed'] = $closed;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isClosed()
    {
        return $this->data['closed'];
    }

    /**
     * {@inheritdoc}
     */
    public function setPinned($pinned)
    {
        $this->data['pinned'] = $pinned;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isPinned()
    {
        return $this->data['pinned'];
    }

    /**
     * {@inheritdoc}
     */
    public function setStarred($starred)
    {
        $this->data['starred'] = $starred;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isStarred()
    {
        return $this->data['starred'];
    }

    /**
     * {@inheritdoc}
     */
    public function setSubscribed($subscribed)
    {
        $this->data['subscribed'] = $subscribed;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isSubscribed()
    {
        return $this->data['subscribed'];
    }

    /**
     * {@inheritdoc}
     */
    public function isInvited()
    {
        return $this->data['invited'];
    }

    /**
     * {@inheritdoc}
     */
    public function setRequiredRoleToInvite($role)
    {
        $this->data['invitations'] = $role;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequiredRoleToInvite()
    {
        return $this->data['invitations'];
    }

    /**
     * {@inheritdoc}
     */
    public function setMemberships(array $memberships)
    {
        $this->data['memberships'] = $memberships;

        return $this;
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
    public function setLabelNames(array $labelNames)
    {
        $this->data['labelNames'] = $labelNames;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLabelNames()
    {
        return $this->data['labelNames'];
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
    public function getDateOfLastActivity()
    {
        return new \DateTime($this->data['dateLastActivity']);
    }

    /**
     * {@inheritdoc}
     */
    public function getDateOfLastView()
    {
        return new \DateTime($this->data['dateLastView']);
    }
}
