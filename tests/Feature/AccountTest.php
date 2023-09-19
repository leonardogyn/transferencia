<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\UserType\Entities\UserType;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    protected $serviceTypeUser = UserType::class;

    /**
     * @test
     */
    public function testStatusCodeShouldBe200()
    {
        $this->get(route('listAccount'),)->assertStatus(200);
    }

    /**
     * @test
     */
    public function testShouldCreateAccount()
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

        $account = [
            'balance' => 123.45,
            'user_id' => $responseUser['id']
        ];

        $responseAccount = $this->postJson(route('createAccount'),$account);

        $responseAccount->assertCreated();
        $responseAccount->assertStatus(201);
        $responseAccount->assertJsonFragment($account);
    }
}
