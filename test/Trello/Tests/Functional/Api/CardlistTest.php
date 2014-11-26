<?php

namespace Trello\Tests\Functional\Api;

use Trello\Api\Cardlist;

/**
 * @group functional
 */
class CardlistTest extends TestCase
{
    /**
     * @test
     */
    public function shouldShowCardlist()
    {
        $cardlistId = '5461eff18059311fcac2c2cf';
        $cardlist = $this->client->api('list')->show($cardlistId, array('fields' => 'all'));

        $this->fieldsExist(Cardlist::$fields, $cardlist);
    }
}
