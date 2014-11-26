<?php

namespace Trello\Tests\Functional\Model;

use Trello\Api\Board;

/**
 * @group functional
 */
class BoardTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateAndCloseBoard()
    {
        $board = $this->service->getBoard();

        $board->setName('Test board');
        $board->setDescription('Test board description');
        $board->save();

        $this->assertInstanceOf('Trello\Model\Board', $board);
        $this->assertNotNull($board->getId());

        $board->setClosed(true);
        $board->save();

        $this->assertTrue($board->isClosed());
    }

    /**
     * @test
     */
    public function shouldShowBoard()
    {
        $board = $this->service->getBoard($this->boardId);

        $this->assertInstanceOf('Trello\Model\Board', $board);
        $this->assertEquals($board->getId(), $this->boardId);
    }

    /**
     * @test
     */
    public function shouldUpdateBoard()
    {
        $data = array(
            'name'        => 'Test as of ' . date('d/m/Y H:i:s'),
            'description' => 'Test description as of ' . date('d/m/Y H:i:s'),
            'closed'      => true,
            // 'pinned'      => true,
            // 'starred'     => true,
            'subscribed'  => true,
            'labelNames'  => array(
                'green'   => 'The green label',
                'blue'    => 'The blue label',
                'purple'  => 'The purple label',
                'red'     => 'The red label'
            ),
        );

        $board = $this->service->getBoard($this->boardId);
        $prevData = $board->getData();

        foreach ($data as $property => $value) {
            $board->{ 'set' . ucfirst($property) }($value);
        }

        $board->save();

        foreach ($data as $property => $expected) {
            $getter = (is_bool($expected) ? 'is' : 'get') . ucfirst($property);
            $actual = $board->$getter();

            if (is_array($expected)) {
                foreach ($expected as $key => $value) {
                    $this->assertArrayHasKey($key, $actual);
                    $this->assertEquals($value, $actual[$key]);
                }
            } else {
                $this->assertEquals($expected, $actual);
            }
        }

        $board->setData($prevData);
        $board->save();
    }
}
