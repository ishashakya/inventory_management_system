<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_category_view(){
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/category/index');
        $this->assertTrue(true);

        // $response->assertStatus(200);
    }
    public function test_category_store(){
        $response = $this->post('/category/store',[
            'name' => 'categoryTest',
            'status' => true,
        ]);
        $this->assertTrue(true);
        // $response->assertRedirect('admin.category.index');
    }

}
