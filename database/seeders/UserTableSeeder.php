<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //Admin
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'admin',
                'status'=>'active',
            ],
            [
                'name'=>'User',
                'email'=>'user@gmail.com',
                'password'=>Hash::make('22222222'),
                'role'=>'user',
                'status'=>'active',
            ]

            //User
        ]);
    }
}
