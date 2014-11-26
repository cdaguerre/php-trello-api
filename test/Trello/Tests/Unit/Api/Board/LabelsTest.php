<?php

namespace Trello\Tests\Unit\Api\Board;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class LabelsTest extends TestCase
{
    protected $apiPath = 'boards/#id#/labels';

    /**
     * @test
     */
    public function shouldGetLabels()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath())
            ->will($this->returnValue('labels'));

        $this->assertEquals('labels', $api->all($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldShowALabel()
    {
        $color = 'green';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/'.$color)
            ->will($this->returnValue($color));

        $this->assertEquals($color, $api->show($this->fakeParentId, $color));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotShowUnexistingLabel()
    {
        $color = 'unexisting';

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('get');

        $api->show($this->fakeParentId, $color);
    }

    /**
     * @test
     */
    public function shouldSetLabelName()
    {
        $color = 'green';
        $name = 'Enhancement';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with('boards/'.$this->fakeParentId.'/labelNames/'.$color)
            ->will($this->returnValue($name));

        $this->assertEquals($name, $api->setName($this->fakeParentId, $color, $name));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotSetNameOfUnexistingLabel()
    {
        $color = 'unexisting';
        $name = 'Enhancement';

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('put');

        $api->setName($this->fakeParentId, $color, $name);
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Board\Labels';
    }
}
