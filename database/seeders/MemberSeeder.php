<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $member = User::where('email', 'member@localhost')->first();
        $user = User::where('email', 'admin@localhost')->first();
        $admin = Admin::where('user_id', $user->id)->first();

        Member::create([
            'member_code' => 'M334',
            'gender' => 'L',
            'address' => 'Jalan Pasir',
            'telp' => '089234133',
            'user_id' => $member->id,
            'admin_id' => $admin->id
        ]);
    }
}
