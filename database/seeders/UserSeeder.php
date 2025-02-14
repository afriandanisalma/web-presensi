<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama agar tidak terjadi duplikasi
        DB::table('users')->truncate();

        // Tambahkan user baru
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
