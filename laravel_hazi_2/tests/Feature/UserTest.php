<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    # 7
    public function testUser()
    {
        $response = $this->get('/user/profile/John');
        $response->assertStatus(200);
    }

    # 9
    public function testUserApi(): void
    {
        $response = $this->post('api/users/add-process');
        $response->assertStatus(200);
    }

    # 10

    public function testWelcome()
    {
        $response = $this->get('/welcome');
        $response->assertStatus(200);
    }

    public function testUserUsername()
    {
        $response = $this->get('/user/John');
        $response->assertStatus(200);
    }

    public function testAdminList()
    {
        $response = $this->get('/admin/list');
        $response->assertStatus(200);
    }
    public function testAdminShow()
    {
        $response = $this->get('/admin/user/1');
        $response->assertStatus(200);
    }

    public function testAdminAdd()
    {
        $response = $this->post('/admin/user/add');
        $response->assertStatus(200);
    }

    public function testAdminUpdate()
    {
        $response = $this->put('/admin/user/update/1');
        $response->assertStatus(200);
    }

    public function testAdminDelete()
    {
        $response = $this->delete('/admin/user/delete/1');
        $response->assertStatus(200);
    }

    public function testAdminParams()
    {
        $response = $this->get('/admin/params/10..20');
        $response->assertStatus(200);
    }

    public function testUserProfile()
    {
        $response = $this->get('/user/profile/John');
        $response->assertStatus(200);
    }
}
