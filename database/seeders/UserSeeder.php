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
        $admin = Admin::where('email', 'admin@localhost')->first();

        User::create([
            'name' => 'Test Name',
            'email' => 'test@localhost',
            'password' => Hash::make('test12345'),
            'user_code' => '1234',
            'address' => 'Jalan Batu',
            'telp' => '0823123233',
            'admin_id' => $admin->id
        ]);
    }
}
