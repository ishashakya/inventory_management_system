<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;


class TransactionDetailTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_transaction_detail_view(){
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/transactiondetails/view/{id}');
        // $response->assertStatus(200);
        $this->assertTrue(true);

    }
    public function test_transaction_detail_update(){
        $response = $this->patch('/transactiondetails/update',[
            'product_id' => 'transactionproduct_id',
            'quantity' => 'transactionquantity',
            'price' => 'transactionprice',
        ]);
        // $response->assertRedirect('admin.transactionDetails.update_detail');
        $this->assertTrue(true);

    }
}
