<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelaySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('relays')->insert([
            [
                'status' => 0, // Relay OFF
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
