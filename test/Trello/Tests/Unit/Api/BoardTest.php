<?php

namespace Trello\Tests\Unit\Api;

/**
 * @group unit
 */
class BoardTest extends TestCase
{
    protected $fakeBoardId = '5461efc60872da1eca5bf45c';
    protected $apiPath = 'boards';

    /**
     * @test
     */
    public function shouldShowBoard()
    {
        $expectedArray = array('id' => $this->fakeBoardId);

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId)
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->show($this->fakeBoardId));
    }

    /**
     * @test
     */
    public function shouldCreateBoard()
    {
        $expectedArray = array('name' => 'Test Board');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->apiPath)
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->create($expectedArray));
    }

    /**
     * @test
     * @expectedException Trello\Exception\MissingArgumentException
     */
    public function shouldNotCreateBoardWithoutName()
    {
        $data = array('desc' => 'Test Board Description');

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->create($data);
    }

    /**
     * @test
     */
    public function shouldUpdateBoard()
    {
        $expectedArray = array('name' => 'Test Board');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId)
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->update($this->fakeBoardId, $expectedArray));
    }

    /**
     * @test
     */
    public function shouldGetField()
    {
        $field = 'desc';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/desc')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getField($this->fakeBoardId, $field));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotGetUnexistingField()
    {
        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('get');

        $api->getField($this->fakeBoardId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldSetName()
    {
        $name = 'Test Board';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/name')
            ->will($this->returnValue($name));

        $this->assertEquals($name, $api->setName($this->fakeBoardId, $name));
    }

    /**
     * @test
     */
    public function shouldSetDescription()
    {
        $description = 'Test Board Description';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/desc')
            ->will($this->returnValue($description));

        $this->assertEquals($description, $api->setDescription($this->fakeBoardId, $description));
    }

    /**
     * @test
     */
    public function shouldSetClosed()
    {
        $closed = true;

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/closed')
            ->will($this->returnValue($closed));

        $this->assertEquals($closed, $api->setClosed($this->fakeBoardId, $closed));
    }

    /**
     * @test
     */
    public function shouldSetSubscribed()
    {
        $subscribed = true;

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/subscribed')
            ->will($this->returnValue($subscribed));

        $this->assertEquals($subscribed, $api->setSubscribed($this->fakeBoardId, $subscribed));
    }

    /**
     * @test
     */
    public function shouldSetViewed()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/markAsViewed')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->setViewed($this->fakeBoardId));
    }

    /**
     * @test
     */
    public function shouldSetOrganization()
    {
        $orgId = $this->fakeId('organization');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/idOrganization/'.$orgId)
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->setOrganization($this->fakeBoardId, $orgId));
    }

    /**
     * @test
     */
    public function shouldGetOrganization()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/organization')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getOrganization($this->fakeBoardId));
    }

    /**
     * @test
     */
    public function shouldGetOrganizationField()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/organization/name')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getOrganizationField($this->fakeBoardId, 'name'));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotGetUnexistingOrganizationField()
    {
        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('get');

        $api->getOrganizationField($this->fakeBoardId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetDeltas()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/deltas')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getDeltas($this->fakeBoardId));
    }

    /**
     * @test
     */
    public function shouldGetStars()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeBoardId.'/boardStars')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getStars($this->fakeBoardId));
    }

    /**
     * @test
     */
    public function shouldGetActionsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Board\Actions', $api->actions());
    }

    /**
     * @test
     */
    public function shouldGetCardlistsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Board\Cardlists', $api->lists());
    }

    /**
     * @test
     */
    public function shouldGetCardsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Board\Cards', $api->cards());
    }

    /**
     * @test
     */
    public function shouldGetChecklistsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Board\Checklists', $api->checklists());
    }

    /**
     * @test
     */
    public function shouldGetLabelsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Board\Labels', $api->labels());
    }

    /**
     * @test
     */
    public function shouldGetMembersApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Board\Members', $api->members());
    }

    /**
     * @test
     */
    public function shouldGetMembershipsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Board\Memberships', $api->memberships());
    }

    /**
     * @test
     */
    public function shouldGetMyPreferencesApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Board\MyPreferences', $api->myPreferences());
    }

    /**
     * @test
     */
    public function shouldGetPowerUpsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Board\PowerUps', $api->powerUps());
    }

    /**
     * @test
     */
    public function shouldGetPreferencesApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Board\Preferences', $api->preferences());
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Board';
    }
}
