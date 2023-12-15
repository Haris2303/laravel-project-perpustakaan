<?php

namespace Tests\Feature;

use Database\Seeders\AdminSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DashboardMemberControllerTest extends TestCase
{
    public function testCreateSuccess()
    {
        $this->seed([UserSeeder::class, AdminSeeder::class]);

        $this->post('/dashboard/members', [
            'name' => 'Member Test',
            'email' => 'membertest@localhost',
            'password' => Hash::make('membertest'),
        ])->assertStatus(201)->assertJson([
            'message' => 'success'
        ]);
    }
}
