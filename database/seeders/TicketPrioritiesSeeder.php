<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class TicketPrioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ticket_priorities')->insert([
            ['name' => 'Rendah'],
            ['name' => 'Sedang'],
            ['name' => 'Tinggi'],
        ]);
    }
}
