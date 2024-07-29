<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'nama' => 'John Doe',
                'username' => 'superadmin',
                'password' => Hash::make('123'),
                'role' => 1,
                'email' => 'johndoe@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Jane Smith',
                'username' => 'admin',
                'password' => Hash::make('123'),
                'role' => 2,
                'email' => 'janesmith@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Jessica Smith',
                'username' => 'admin2',
                'password' => Hash::make('123'),
                'role' => 2,
                'email' => 'jessicasmith@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Josh Smith',
                'username' => 'pembaca',
                'password' => Hash::make('123'),
                'role' => 3,
                'email' => 'joshsmith@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Jovi Smith',
                'username' => 'pembaca2',
                'password' => Hash::make('123'),
                'role' => 3,
                'email' => 'jovismith@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan user lain di sini jika perlu
        ]);
    }
}
