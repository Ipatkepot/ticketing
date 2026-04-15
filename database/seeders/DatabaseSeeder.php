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
        // User::factory(10)->create();

        $this->call([
        UserTypeSeeder::class,
        TicketCategoriesSeeder::class,
        TicketPrioritiesSeeder::class,
    ]);
    \App\Models\User::create([
        'name' => 'Mahasiswa User',
        'email' => 'mahasiswa@gmail.com',
        'password' => bcrypt('password'),
        'usertype' => 'mahasiswa',
    ]);
    \App\Models\User::create([
        'name' => 'Admin User',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('password'), 
        'usertype' => 'admin',
    ]);

    \App\Models\User::create([
        'name' => 'Staff User',
        'email' => 'staff@gmail.com',
        'password' => bcrypt('password'),
        'usertype' => 'staff',
    ]);

    \App\Models\User::create([
        'name' => 'Ketuap3ti User',
        'email' => 'ketuap3ti@gmail.com',
        'password' => bcrypt('password'),
        'usertype' => 'ketuap3ti',
    ]);

    
    \App\Models\User::create([
        'name' => 'Pimpinan User',
        'email' => 'pimpinan@gmail.com',
        'password' => bcrypt('password'),
        'usertype' => 'pimpinan',
    ]);
    }
}
