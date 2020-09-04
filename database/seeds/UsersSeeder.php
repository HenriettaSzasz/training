<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->updateOrInsert([
            'name' => 'Customer',
            'email' => 'user-test@yopmail.com',
            'email_verified_at' => date('Y-m-d h:i:s'),
            'password' => Hash::make('user'),
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table('users')->updateOrInsert([
            'name' => 'Admin',
            'email' => 'admin-test@yopmail.com',
            'email_verified_at' => date('Y-m-d h:i:s'),
            'password' => Hash::make('admin'),
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
            'isAdmin' => true,
        ]);
    }
}
