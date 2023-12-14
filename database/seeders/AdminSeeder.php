<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@localhost',
            'password' => Hash::make('admin12345'),
            'address' => 'Jalan Batu',
            'nip' => '12341234'
        ]);
    }
}
