<?php

namespace Trello\Tests\Unit\Api;

/**
 * @group unit
 */
class MemberTest extends TestCase
{
    protected $fakeMemberId = '5461efc60872da1eca5bf45c';
    protected $apiPath = 'members';

    /**
     * @test
     */
    public function shouldShowMember()
    {
        $expectedArray = array('id' => $this->fakeMemberId);

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeMemberId)
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->show($this->fakeMemberId));
    }

    /**
     * @test
     */
    public function shouldUpdateMember()
    {
        $expectedArray = array('id' => $this->fakeMemberId);

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId)
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->update($this->fakeMemberId, $expectedArray));
    }

    /**
     * @test
     */
    public function shouldGetDeltas()
    {
        $expectedArray = array('id' => $this->fakeMemberId);

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/deltas')
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->getDeltas($this->fakeMemberId));
    }

    /**
     * @test
     */
    public function shouldSetUsername()
    {
        $username = 'TestUser';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/username')
            ->will($this->returnValue($username));

        $this->assertEquals($username, $api->setUsername($this->fakeMemberId, $username));
    }

    /**
     * @test
     */
    public function shouldSetBio()
    {
        $bio = 'bio';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/bio')
            ->will($this->returnValue($bio));

        $this->assertEquals($bio, $api->setBio($this->fakeMemberId, $bio));
    }

    /**
     * @test
     */
    public function shouldSetAvatar()
    {
        $avatar = 'avatar';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/avatar')
            ->will($this->returnValue($avatar));

        $this->assertEquals($avatar, $api->setAvatar($this->fakeMemberId, $avatar));
    }

    /**
     * @test
     */
    public function shouldSetAvatarSource()
    {
        $avatarSource = 'avatarSource';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/avatarSource')
            ->will($this->returnValue($avatarSource));

        $this->assertEquals($avatarSource, $api->setAvatarSource($this->fakeMemberId, $avatarSource));
    }

    /**
     * @test
     */
    public function shouldSetInitials()
    {
        $initials = 'AA';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/initials')
            ->will($this->returnValue($initials));

        $this->assertEquals($initials, $api->setInitials($this->fakeMemberId, $initials));
    }

    /**
     * @test
     */
    public function shouldSetFullName()
    {
        $fullName = 'John Doe';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeMemberId.'/fullName')
            ->will($this->returnValue($fullName));

        $this->assertEquals($fullName, $api->setFullName($this->fakeMemberId, $fullName));
    }

    /**
     * @test
     */
    public function shouldGetActionsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Member\Actions', $api->actions());
    }

    /**
     * @test
     */
    public function shouldGetBoardsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Member\Boards', $api->boards());
    }

    /**
     * @test
     */
    public function shouldGetCardsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Member\Cards', $api->cards());
    }

    /**
     * @test
     */
    public function shouldGetCustomBackgroundsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Member\CustomBackgrounds', $api->customBackgrounds());
    }

    /**
     * @test
     */
    public function shouldGetCustomEmojiApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Member\CustomEmoji', $api->customEmoji());
    }

    /**
     * @test
     */
    public function shouldGetCustomStickersApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Member\CustomStickers', $api->customStickers());
    }

    /**
     * @test
     */
    public function shouldGetNotificationsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Member\Notifications', $api->notifications());
    }

    /**
     * @test
     */
    public function shouldGetOrganizationsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Member\Organizations', $api->organizations());
    }

    /**
     * @test
     */
    public function shouldGetSavedSearchesApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Member\SavedSearches', $api->savedSearches());
    }

    /**
     * @test
     */
    public function shouldGetBoardBackgroundsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Member\Board\Backgrounds', $api->boards()->backgrounds());
    }

    /**
     * @test
     */
    public function shouldGetBoardStarsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Member\Board\Stars', $api->boards()->stars());
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Member';
    }
}
