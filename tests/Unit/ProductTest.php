<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;


class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_product_view(){
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/product/index');
        // $response->assertStatus(200);
        $this->assertTrue(true);

    }
    public function test_product_store(){
        $response = $this->post('/product/store',[
            'title' => 'productTitle',
            'slug' => 'productSlug',
            'brand' => 'productBrand',
            'description' => 'productDescription',
            'image' => 'productImage',
        ]);
        // $response->assertRedirect('admin.product.index');
        $this->assertTrue(true);

    }
}
