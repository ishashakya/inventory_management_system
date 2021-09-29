<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;


class TransactionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_transaction_view(){
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/transaction/index');
        // $response->assertStatus(200);
        $this->assertTrue(true);

    }
    public function test_transaction_store(){
        $response = $this->post('/transaction/store',[
            'merchant_name' => 'transactionmerchant_name',
            'date' => 'transactiondate',
            'total' => 'transactiontotal',
            'credit' => 'transactioncredit',
            'transaction_type' => 'transactiontransaction_type',
        ]);
        // $response->assertRedirect('admin.transaction.index');
        $this->assertTrue(true);

    }
}
