<?php

namespace Trello\Tests\Unit\Api\Card;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class LabelsTest extends TestCase
{
    protected $apiPath = 'cards/#id#/labels';

    /**
     * @test
     */
    public function shouldSetLabels()
    {
        $labels = array('green', 'purple');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->getPath())
            ->will($this->returnValue($labels));

        $this->assertEquals($labels, $api->set($this->fakeParentId, $labels));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotSetUnexistingLabels()
    {
        $labels = array('unexisting', 'purple');

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('put');

        $api->set($this->fakeParentId, $labels);
    }

    /**
     * @test
     */
    public function shouldRemoveALabel()
    {
        $label = 'green';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/'.$label)
            ->will($this->returnValue($label));

        $this->assertEquals($label, $api->remove($this->fakeParentId, $label));
    }

    /**
     * @test
     * @expectedException Trello\Exception\InvalidArgumentException
     */
    public function shouldNotRemoveUnexistingLabel()
    {
        $label = 'unexisting';

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('put');

        $api->remove($this->fakeParentId, $label);
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Card\Labels';
    }
}
