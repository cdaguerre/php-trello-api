<?php

namespace Trello\Tests\Unit\Api;

/**
 * @group unit
 */
class ChecklistTest extends TestCase
{
    protected $fakeChecklistId = '5461efc60872da1eca5bf45c';
    protected $apiPath = 'checklists';

    /**
     * @test
     */
    public function shouldShowChecklist()
    {
        $expectedArray = array('id' => $this->fakeChecklistId);

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeChecklistId)
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->show($this->fakeChecklistId));
    }

    /**
     * @test
     */
    public function shouldCreateChecklist()
    {
        $expectedArray = array(
            'name' => 'Test Checklist',
            'idCard' => $this->fakeId('list'),
        );

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
    public function shouldNotCreateChecklistWithoutName()
    {
        $data = array(
            'idCard' => $this->fakeId('list'),
        );

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->create($data);
    }

    /**
     * @test
     * @expectedException Trello\Exception\MissingArgumentException
     */
    public function shouldNotCreateChecklistWithoutCardId()
    {
        $data = array(
            'name'   => 'Test Checklist',
        );

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->create($data);
    }

    /**
     * @test
     */
    public function shouldUpdateChecklist()
    {
        $expectedArray = array('name' => 'Test Checklist');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeChecklistId)
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->update($this->fakeChecklistId, $expectedArray));
    }

    /**
     * @test
     */
    public function shouldRemoveChecklist()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->apiPath.'/'.$this->fakeChecklistId)
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->remove($this->fakeChecklistId));
    }

    /**
     * @test
     */
    public function shouldGetField()
    {
        $field = 'name';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeChecklistId.'/name')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getField($this->fakeChecklistId, $field));
    }

    /**
     * @test
     */
    public function shouldGetBoard()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeChecklistId.'/board')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getBoard($this->fakeChecklistId));
    }

    /**
     * @test
     */
    public function shouldGetBoardField()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeChecklistId.'/board/name')
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->getBoardField($this->fakeChecklistId, 'name'));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotGetUnexistingBoardField()
    {
        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('get');

        $api->getBoardField($this->fakeChecklistId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldSetCard()
    {
        $card = $this->fakeId('card');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeChecklistId.'/idCard')
            ->will($this->returnValue($card));

        $this->assertEquals($card, $api->setCard($this->fakeChecklistId, $card));
    }

    /**
     * @test
     */
    public function shouldSetName()
    {
        $name = 'Test Checklist';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeChecklistId.'/name')
            ->will($this->returnValue($name));

        $this->assertEquals($name, $api->setName($this->fakeChecklistId, $name));
    }

    /**
     * @test
     */
    public function shouldSetPosition()
    {
        $position = true;

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeChecklistId.'/pos')
            ->will($this->returnValue($position));

        $this->assertEquals($position, $api->setPosition($this->fakeChecklistId, $position));
    }

    /**
     * @test
     */
    public function shouldGetItemsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Checklist\Items', $api->items());
    }

    /**
     * @test
     */
    public function shouldGetCardsApiObject()
    {
        $api = $this->getApiMock();
        $this->assertInstanceOf('Trello\Api\Checklist\Cards', $api->cards());
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Checklist';
    }
}
