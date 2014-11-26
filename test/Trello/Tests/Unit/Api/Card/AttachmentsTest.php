<?php

namespace Trello\Tests\Unit\Api\Card;

use Trello\Tests\Unit\Api\TestCase;

/**
 * @group unit
 */
class AttachmentsTest extends TestCase
{
    protected $apiPath = 'cards/#id#/attachments';

    /**
     * @test
     */
    public function shouldGetAllAttachments()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath())
            ->will($this->returnValue($this->fakeId));

        $this->assertEquals($this->fakeId, $api->all($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldShowAttachment()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/'.$this->fakeId)
            ->will($this->returnValue($this->fakeId));

        $this->assertEquals($this->fakeId, $api->show($this->fakeParentId, $this->fakeId));
    }


    /**
     * @test
     */
    public function shouldCreateAttachment()
    {
        $data = array('url' => 'http://www.test.com/image.jpg');

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
    public function shouldNotCreateAttachmentWhenParamsIncomplete()
    {
        $data = array();

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->create($this->fakeParentId, $data);
    }

    /**
     * @test
     */
    public function shouldRemoveAttachment()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId)
            ->will($this->returnValue($this->fakeId));

        $this->assertEquals($this->fakeId, $api->remove($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldSetAsCover()
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with('cards/'.$this->fakeParentId.'/idAttachmentCover')
            ->will($this->returnValue($this->fakeId));

        $this->assertEquals($this->fakeId, $api->setAsCover($this->fakeParentId, $this->fakeId));
    }


    protected function getApiClass()
    {
        return 'Trello\Api\Card\Attachments';
    }
}
