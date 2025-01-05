<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Naufal Zhafif Pradipta',
                'email' => 'zhafif@mail.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Aurel Putri Widyanti',
                'email' => 'aurel@mail.com',
                'password' => bcrypt('12345678'),
            ],
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
