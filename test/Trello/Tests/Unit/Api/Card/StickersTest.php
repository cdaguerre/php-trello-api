<?php

namespace Trello\Tests\Unit\Api\Card;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class StickersTest extends TestCase
{
    protected $apiPath = 'cards/#id#/stickers';

    /**
     * @test
     */
    public function shouldGetAllStickers()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath())
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->all($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldShowSticker()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/'.$this->fakeId)
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->show($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldCreateSticker()
    {
        $data = array(
            'image'  => 'http://www.test.com/fake-image-url.jpg',
            'top'    => 0,
            'left'   => 0,
            'zIndex' => 1,
        );

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->will($this->returnValue($data));

        $this->assertEquals($data, $api->create($this->fakeParentId, $data));
    }

    /**
     * @test
     * @expectedException Trello\Exception\MissingArgumentException
     */
    public function shouldNotCreateStickerWhenParamsIncomplete()
    {
        $data = array(
            'top'    => 0,
            'left'   => 0,
            'zIndex' => 1,
        );

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->create($this->fakeParentId, $data);
    }

    /**
     * @test
     */
    public function shouldUpdateSticker()
    {
        $data = array(
            'top'    => 2,
            'left'   => 2,
            'zIndex' => 2,
        );

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->getPath().'/'.$this->fakeId)
            ->will($this->returnValue($data));

        $this->assertEquals($data, $api->update($this->fakeParentId, $this->fakeId, $data));
    }

    /**
     * @test
     * @expectedException Trello\Exception\MissingArgumentException
     */
    public function shouldNotUpdateStickerWithoutAtLeastOneAllowedParam()
    {
        $data = array();

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('put');

        $api->update($this->fakeParentId, $this->fakeId, $data);
    }

    /**
     * @test
     */
    public function shouldRemoveSticker()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId)
            ->will($this->returnValue(true));

        $this->assertEquals(true, $api->remove($this->fakeParentId, $this->fakeId));
    }

    protected function getApiClass()
    {
        return 'Trello\Api\Card\Stickers';
    }
}
