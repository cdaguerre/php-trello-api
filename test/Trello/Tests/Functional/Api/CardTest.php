<?php

namespace Trello\Tests\Functional\Api;

use Trello\Api\Card;

/**
 * @group functional
 */
class CardTest extends TestCase
{
    protected $cardId = '546507f81532998f24b4f835';

    /**
     * @test
     */
    public function shouldShowCard()
    {
        $card = $this->client->api('card')->show($this->cardId, array('fields' => 'all'));

        $this->fieldsExist(Card::$fields, $card);
    }

    /**
     * @test
     */
    public function shouldUpdate()
    {
        $cardName = 'Trello-Github test card';
        $cardNameTest = $cardName . ' ' . time();

        $card = $this->client->api('card')->show($this->cardId, array('fields' => 'all'));

        $card['name'] = $cardNameTest;
        $card['closed'] = true;
        $card = $this->client->api('card')->update($this->cardId, $card);

        $this->assertEquals($card['name'], $cardNameTest);
        $this->assertTrue($card['closed']);

        $card['name'] = $cardName;
        $card['closed'] = false;
        $card = $this->client->api('card')->update($this->cardId, $card);

        $this->assertEquals($card['name'], $cardName);
        $this->assertFalse($card['closed']);
    }

    /**
     * @test
     */
    public function shouldSetName()
    {
        $cardName = 'Trello-Github test card';
        $cardNameTest = $cardName . ' ' . time();

        $card = $this->client->api('card')->setName($this->cardId, $cardNameTest);
        $this->assertEquals($card['name'], $cardNameTest);

        $card = $this->client->api('card')->setName($this->cardId, $cardName);
        $this->assertEquals($card['name'], $cardName);
    }
}
