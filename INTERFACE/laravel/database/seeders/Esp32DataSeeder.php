<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Esp32DataSeeder extends Seeder
{
    public function run(): void
    {
        $startDate = Carbon::create(2025, 3, 25, 0, 0, 0); // Mulai dari 25 Maret, pukul 00:00
        $endDate = Carbon::create(2025, 3, 30, 23, 59, 59); // Sampai 30 Maret, pukul 23:59

        while ($startDate <= $endDate) {
            DB::table('esp32data')->insert([
                'waktu' => $startDate->toDateTimeString(),
                'Voltage' => rand(210, 230) + (rand(0, 99) / 100),
                'Current' => rand(0, 10) + (rand(0, 99) / 100),
                'Power' => rand(100, 500) + (rand(0, 99) / 100),
                'Energy' => rand(1000, 5000) + (rand(0, 99) / 100),
                'Frequency' => rand(49, 51) + (rand(0, 99) / 100),
                'PowerFactor' => rand(80, 100) / 100,
            ]);
            
            $startDate->addHour(); // Tambah 1 jam
        }
    }
}
