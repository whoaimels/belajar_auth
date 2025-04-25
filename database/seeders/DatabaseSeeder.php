<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'role'  => 'admin',
            'password' => bcrypt('adminlogin')
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'role'  => 'user',
            'password' => bcrypt('user')
        ]);
    }
}
