<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class TicketCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ticket_categories')->insert([
            ['name' => 'Listrik'],
            ['name' => 'Wi-fi/Internet'],
            ['name' => 'Air'],
            ['name' => 'AC'],
        ]);
    }
}
