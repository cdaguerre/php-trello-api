<?php

namespace Trello\Tests\Functional\Api;

use Trello\Api\Organization;

/**
 * @group functional
 */
class OrganizationTest extends TestCase
{
    /**
     * @test
     */
    public function shouldShowOrganization()
    {
        $organizationId = '54738ebbb5d98f54e583f855';
        $organization = $this->client->api('organization')->show($organizationId, array('fields' => 'all'));

        $this->fieldsExist(Organization::$fields, $organization);
    }
}
