<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\UserType\Entities\UserType;
use Tests\TestCase;

class TransferTest extends TestCase
{
    protected $serviceTypeUser = UserType::class;

    /**
     * @test
     */
    public function testStatusCodeShouldBe200()
    {
        $this->get(route('listTransfer'),)->assertStatus(200);
    }

    /**
     * @test
     */
    public function testShouldCreateTransferBetweenUsersCommon()
    {

        $userType = [
            'name' => 'Comum',
            'flag' => 'C'
        ];

        $response = $this->postJson(route('createUserType'),$userType);

        $user1 = [
            'name' => 'João',
            'cpf_cnpj' => '12312312312',
            'email' => 'joao@gmail.com',
            'password' => 'J@123',
            'user_type_id' => $response['id']
        ];

        $responseUser1 = $this->postJson(route('createUser'),$user1);

        $account1 = [
            'balance' => 123.45,
            'user_id' => $responseUser1['id']
        ];

        $responseAccount1 = $this->postJson(route('createAccount'),$account1);

        $user2 = [
            'name' => 'Maria',
            'cpf_cnpj' => '12312312313',
            'email' => 'maria@gmail.com',
            'password' => 'M@123',
            'user_type_id' => $response['id']
        ];

        $responseUser2 = $this->postJson(route('createUser'),$user2);

        $account2 = [
            'balance' => 234.56,
            'user_id' => $responseUser2['id']
        ];

        $responseAccount2 = $this->postJson(route('createAccount'),$account2);

        $transfer = [
            'account_payer_id' => $responseAccount1['id'],
            'account_payee_id' => $responseAccount2['id'],
            'value' => 34.56
        ];

        $responseTransfer = $this->postJson(route('createTransfer'),$transfer);

        $responseTransfer->assertCreated();
        $responseTransfer->assertStatus(201);
        $responseTransfer->assertJsonFragment($transfer);
    }

    /**
     * @test
     */
    public function testShouldCreateTransferBetweenUserCommonAndShopkeeper()
    {

        $userTypeCommom = [
            'name' => 'Comum',
            'flag' => 'C'
        ];

        $responseCommom = $this->postJson(route('createUserType'),$userTypeCommom);

        $user1 = [
            'name' => 'João',
            'cpf_cnpj' => '12312312312',
            'email' => 'joao@gmail.com',
            'password' => 'J@123',
            'user_type_id' => $responseCommom['id']
        ];

        $responseUser1 = $this->postJson(route('createUser'),$user1);

        $account1 = [
            'balance' => 123.45,
            'user_id' => $responseUser1['id']
        ];

        $responseAccount1 = $this->postJson(route('createAccount'),$account1);

        $userTypeShopkeeper = [
            'name' => 'Lojista',
            'flag' => 'L'
        ];

        $responseShopkeeper = $this->postJson(route('createUserType'),$userTypeShopkeeper);

        $user2 = [
            'name' => 'XPTO Company',
            'cpf_cnpj' => '12312312312312',
            'email' => 'xpto@company.com',
            'password' => 'X@123',
            'user_type_id' => $responseShopkeeper['id']
        ];

        $responseUser2 = $this->postJson(route('createUser'),$user2);

        $account2 = [
            'balance' => 234.56,
            'user_id' => $responseUser2['id']
        ];

        $responseAccount2 = $this->postJson(route('createAccount'),$account2);

        $transfer = [
            'account_payer_id' => $responseAccount1['id'],
            'account_payee_id' => $responseAccount2['id'],
            'value' => 34.56
        ];

        $responseTransfer = $this->postJson(route('createTransfer'),$transfer);

        $responseTransfer->assertCreated();
        $responseTransfer->assertStatus(201);
        $responseTransfer->assertJsonFragment($transfer);
    }
}
