<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\UserType\Entities\UserType;
use Tests\TestCase;

class UserTypeTest extends TestCase
{
    use RefreshDatabase;

    protected $service = UserType::class;

    /**
     * @test
     */
    public function testStatusCodeShouldBe200()
    {
        $this->get(route('listUserType'),)->assertStatus(200);
    }

    /**
     * @test
     */
    public function testShouldCreateUserType()
    {

        $userType = factory($this->service)->make();

        $response = $this->postJson(route('createUserType'),$userType->toArray());

        $response->assertCreated();
        $response->assertStatus(201);

    }
}
