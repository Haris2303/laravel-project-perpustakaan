<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Member;
use App\Models\User;
use Database\Seeders\AdminSeeder;
use Database\Seeders\MemberSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeederTest extends TestCase
{
    public function testCreateUser()
    {
        $this->seed(UserSeeder::class);

        $this->assertNotNull(User::where('email', 'admin@localhost')->first());
        $this->assertNotNull(User::where('email', 'member@localhost')->first());
    }

    public function testCreateAdmin()
    {
        $this->seed([UserSeeder::class, AdminSeeder::class]);

        $user = User::where('email', 'admin@localhost')->firstOrFail();
        $admin = Admin::where('user_id', $user->id)->firstOrFail();

        $this->assertNotNull($admin);
    }

    public function testCreateMember()
    {
        $this->seed([UserSeeder::class, AdminSeeder::class, MemberSeeder::class]);

        $user = User::where('email', 'admin@localhost')->firstOrFail();
        $admin = Admin::where('user_id', $user->id)->firstOrFail();
        $member = Member::where('admin_id', $admin->id)->firstOrfail();

        $this->assertNotNull($member);
    }
}
