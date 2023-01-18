<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name' => 'Nasi Uduk Bu As',
                'email' => 'asbusiness@mail.com',
                'password' => Hash::make('pass1'),
                'is_umkm' => true,
                'is_admin' => false
            ],
            [
                'name' => 'Riku Tailor',
                'email' => 'tailorriku@mail.com',
                'password' => Hash::make('pass2'),
                'is_umkm' => true,
                'is_admin' => false
            ],
            [
                'name' => 'Silver Star Education',
                'email' => 'silverstaredu@mail.com',
                'password' => Hash::make('pass3'),
                'is_umkm' => true,
                'is_admin' => false
            ],
            [
                'name' => 'Admin1',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin123'),
                'is_umkm' => false,
                'is_admin' => true
            ]
        ]);
    }
}
