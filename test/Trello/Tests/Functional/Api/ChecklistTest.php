<?php

namespace Trello\Tests\Functional\Api;

use Trello\Api\Checklist;

/**
 * @group functional
 */
class ChecklistTest extends TestCase
{
    /**
     * @test
     */
    public function shouldShowChecklist()
    {
        $checklistId = '546a00c70cb58a3498516904';
        $checklist = $this->client->api('checklist')->show($checklistId, array('fields' => 'all'));

        $this->fieldsExist(Checklist::$fields, $checklist);
    }
}
