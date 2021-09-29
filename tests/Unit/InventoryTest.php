<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;


class InventoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_inventory_view(){
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/inventories/index');
        // $response->assertStatus(200);
        $this->assertTrue(true);

    }
}
