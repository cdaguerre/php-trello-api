<?php

namespace Trello\Api;

/**
 * Trello Member API
 * @link https://trello.com/docs/api/member
 *
 * Not implemented:
 * - Board backgrounds API @see Member\Board\Backgrounds
 * - Board stars API @see Member\Board\Stars
 * - Custom backgrounds API @see Member\CustomBackgrounds
 * - Saved Searches API @see Member\SavedSearches
 * - Custom Emoji API @see Member\CustomEmoji
 * - Custom Stickers API @see Member\CustomStickers
 * - https://trello.com/docs/api/member/#get-1-members-idmember-or-username-tokens
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-prefs-colorblind
 * - https://trello.com/docs/api/member/#put-1-members-idmember-or-username-prefs-minutesbetweensummaries
 * - https://trello.com/docs/api/member/#post-1-members-idmember-or-username-onetimemessagesdismissed
 * - https://trello.com/docs/api/member/#post-1-members-idmember-or-username-unpaidaccount
 */
class Member extends AbstractApi
{
    /**
     * Base path of members api
     * @var string
     */
    protected $path = 'members';

    /**
     * Member fields
     * @link https://trello.com/docs/api/member/#get-1-members-idmember-or-username-field
     * @var array
     */
    public static $fields = array(
        'avatarHash',
        'bio',
        'bioData',
        'confirmed',
        'fullName',
        'idPremOrgsAdmin',
        'initials',
        'memberType',
        'products',
        'status',
        'url',
        'username',
        'avatarSource',
        'email',
        'gravatarHash',
        'idBoards',
        'idBoardsPinned',
        'idOrganizations',
        'loginTypes',
        'newEmail',
        'oneTimeMessagesDismissed',
        'prefs',
        'status',
        'trophies',
        'uploadedAvatarHash',
        'premiumFeatures'
    );

    /**
     * Find a member by id or username
     * @link https://trello.com/docs/api/member/index.html#get-1-members-idmember-or-username
     *
     * @param string $id     the member's id or username
     * @param array  $params optional attributes
     *
     * @return array list info
     */
    public function show($id, array $params = array())
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Update a member
     * @link https://trello.com/docs/api/member/#put-1-members-idmember-or-username
     *
     * @param string $id     the member's id or username
     * @param array  $params attributes to update: 'fullName', 'initials', 'username', 'bio',
     *                       'avatarSource', 'prefs/colorBlind', 'prefs/minutesBetweenSummaries'
     *
     * @return array list info
     */
    public function update($id, array $params = array())
    {
        return $this->put($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Get a given member's deltas
     * @link https://trello.com/docs/api/member/#get-1-members-idmember-or-username-deltas
     *
     * @param string $id     the member's id or username
     * @param array  $params optional parameters
     *
     * @return array
     */
    public function getDeltas($id, array $params = array())
    {
        return $this->get($this->path.'/'.rawurlencode($id).'/deltas', $params);
    }

    /**
     * Set a given member's avatarSource
     * @link https://trello.com/docs/api/member/#put-1-members-idmember-or-username-avatarSource
     *
     * @param string $id           the member's id or username
     * @param string $avatarSource the avatarSource, one of 'none', 'upload', 'gravatar'
     *
     * @return array
     */
    public function setAvatarSource($id, $avatarSource)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/avatarSource', array('value' => $avatarSource));
    }

    /**
     * Set a given member's bio
     * @link https://trello.com/docs/api/member/#put-1-members-idmember-or-username-bio
     *
     * @param string $id  the member's id or username
     * @param string $bio the bio
     *
     * @return array
     */
    public function setBio($id, $bio)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/bio', array('value' => $bio));
    }

    /**
     * Set a given member's full name
     * @link https://trello.com/docs/api/member/#put-1-members-idmember-or-username-fullname
     *
     * @param string $id       the member's id or username
     * @param string $fullName the full name
     *
     * @return array
     */
    public function setFullName($id, $fullName)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/fullName', array('value' => $fullName));
    }

    /**
     * Set a given member's initials
     * @link https://trello.com/docs/api/member/#put-1-members-idmember-or-username-initials
     *
     * @param string $id       the member's id or username
     * @param string $initials the initials
     *
     * @return array
     */
    public function setInitials($id, $initials)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/initials', array('value' => $initials));
    }

    /**
     * Set a given member's username
     * @link https://trello.com/docs/api/member/#put-1-members-idmember-or-username-username
     *
     * @param string $id       the member's id or username
     * @param string $username the username
     *
     * @return array
     */
    public function setUsername($id, $username)
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/username', array('value' => $username));
    }

    /**
     * Set a given member's avatar
     * @link https://trello.com/docs/api/member/#put-1-members-idmember-or-avatar-avatar
     *
     * @param string $id     the member's id or avatar
     *
     * @return array
     */
    public function setAvatar($id, $file)
    {
        return $this->post($this->getPath().'/'.rawurlencode($id).'/avatar', array('file' => $file));
    }

    /**
     * Actions API
     *
     * @return Member\Actions
     */
    public function actions()
    {
        return new Member\Actions($this->client);
    }

    /**
     * Boards API
     *
     * @return Member\Boards
     */
    public function boards()
    {
        return new Member\Boards($this->client);
    }

    /**
     * Cards API
     *
     * @return Member\Cards
     */
    public function cards()
    {
        return new Member\Cards($this->client);
    }

    /**
     * Notifications API
     *
     * @return Member\Notifications
     */
    public function notifications()
    {
        return new Member\Notifications($this->client);
    }

    /**
     * Organizations API
     *
     * @return Member\Organizations
     */
    public function organizations()
    {
        return new Member\Organizations($this->client);
    }

    /**
     * Custom Backgrounds API
     *
     * @return Member\CustomBackgrounds
     */
    public function customBackgrounds()
    {
        return new Member\CustomBackgrounds($this->client);
    }

    /**
     * Custom Emoji API
     *
     * @return Member\CustomEmoji
     */
    public function customEmoji()
    {
        return new Member\CustomEmoji($this->client);
    }

    /**
     * Custom Stickers API
     *
     * @return Member\CustomStickers
     */
    public function customStickers()
    {
        return new Member\CustomStickers($this->client);
    }

    /**
     * Saved Searches API
     *
     * @return Member\SavedSearches
     */
    public function savedSearches()
    {
        return new Member\SavedSearches($this->client);
    }
}
