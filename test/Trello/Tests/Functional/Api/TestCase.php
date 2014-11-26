<?php

namespace Trello\Tests\Functional\Api;

use Trello\Tests\Functional\TestCase as BaseCase;

/**
 * @group functional
 */
class TestCase extends BaseCase
{
    protected function fieldsExist(array $fields, array $response)
    {
        foreach ($fields as $field) {
            $this->assertArrayHasKey($field, $response);
        }
    }
}
