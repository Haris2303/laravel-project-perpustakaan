<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@localhost')->first();

        Admin::create([
            'address' => 'Jalan Batu',
            'telp' => '0822222222',
            'user_id' => $user->id,
        ]);
    }
}
