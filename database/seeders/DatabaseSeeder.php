<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Roles::create([
            'id' => 1,
            'roles' => 'Administrator',
            'slug' => 'administrator'
        ]);

        Roles::create([
            'id' => 2,
            'roles' => 'Buyer',
            'slug' => 'buyer'
        ]);

        User::create([
            'nama_lengkap' => 'Administrator',
            'username' => 'administrator',
            'email' => 'administrator@example.com',
            'password' => Hash::make('password'),
            'roles_id' => 1
        ]);
    }
}
