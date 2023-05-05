<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTypeTest extends TestCase
{
    /**
     * @test
     */
    public function testStatusCodeShouldBe200()
    {
        $this->get('api/type-user/list')->assertStatus(200);
    }

    /**
     * @test
     */
    public function testShouldCreateUserType()
    {

        $this->get('api/type-user/create')->assertStatus(200);
    }
}
