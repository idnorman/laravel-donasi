<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            "name" => "Admin",
            "email" => "admin@email.com",
            "password" => Hash::make("password"),
        ]);

        $admin->assignRole("admin");

        $donatur = User::create([
            "name" => "Donatur",
            "email" => "donatur@email.com",
            "password" => Hash::make("password"),
        ]);
        $donatur->assignRole("donatur");

        User::factory(30)->create();


    }
}
