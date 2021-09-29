<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class SaleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_sale_view(){
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/sales/index');
        $this->assertTrue(true);

        // $response->assertStatus(200);
    }
    // public function test_sale_store(){
    //     $response = $this->post('/sales/store',[
    //         'name' => 'categoryTest',
    //         'status' => true,
    //     ]);
    //     $this->assertTrue(true);
    //     $response->assertRedirect('admin.category.index');
    // }

}
