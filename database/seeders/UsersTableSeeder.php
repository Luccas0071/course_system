<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'name' => 'Lucas Oliveira',
                'email' => 'lucas@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 02',
                'email' => 'user02@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 03',
                'email' => 'user03@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 04',
                'email' => 'user04@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 05',
                'email' => 'user05@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
