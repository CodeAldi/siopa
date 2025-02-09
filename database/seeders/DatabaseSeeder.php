<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'nik' => '000000000',
            'role' => UserRole::admin,
        ]);
        User::create([
            'name' => 'budi',
            'email' => 'budi@gmail.com',
            'password' => bcrypt('12345678'),
            'nik' => '1111111111',
            'role' => UserRole::anggota,
        ]);
        User::create([
            'name' => 'anton',
            'email' => 'anton@gmail.com',
            'password' => bcrypt('12345678'),
            'nik' => '2222222222',
            'role' => UserRole::pengurus,
        ]);
        User::create([
            'name' => 'rziki',
            'email' => 'rziki@gmail.com',
            'password' => bcrypt('12345678'),
            'nik' => '333333333',
            'role' => UserRole::masyarakat,
        ]);
    }
}
