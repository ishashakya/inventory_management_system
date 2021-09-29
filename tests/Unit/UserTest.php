<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }
    public function test_login_form(){
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
    public function test_register(){
        $response = $this->post('/submit/register',[
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123'
        ]);
        $response->assertStatus(419);

    }
}
