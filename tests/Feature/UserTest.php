<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\UserType\Entities\UserType;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected $serviceTypeUser = UserType::class;

    /**
     * @test
     */
    public function testStatusCodeShouldBe200()
    {
        $this->get(route('listUser'),)->assertStatus(200);
    }

    /**
     * @test
     */
    public function testShouldCreateUser()
    {

        $userType = factory($this->serviceTypeUser)->make();

        $response = $this->postJson(route('createUserType'),$userType->toArray());

        $user = [
            'name' => 'João',
            'cpf_cnpj' => '12312312312',
            'email' => 'joao@gmail.com',
            'password' => 'J@123',
            'user_type_id' => $response['id']
        ];

        $responseUser = $this->postJson(route('createUser'),$user);

        $responseUser->assertCreated();
        $responseUser->assertStatus(201);
        $responseUser->assertJsonFragment([
            'name' => 'João',
            'cpf_cnpj' => '12312312312',
            'email' => 'joao@gmail.com',
            'user_type_id' => $response['id']
        ]);
    }
}
