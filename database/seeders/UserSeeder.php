<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\map;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@localhost',
            'password' => Hash::make('admin12345'),
            'is_admin' => true
        ]);

        User::create([
            'name' => 'Member Name',
            'email' => 'member@localhost',
            'password' => Hash::make('member12345'),
            'is_admin' => false
        ]);

        User::create([
            'name' => 'Admin Dua',
            'email' => 'admin2@localhost',
            'password' => Hash::make('admin212345'),
            'is_admin' => true
        ]);
    }
}
