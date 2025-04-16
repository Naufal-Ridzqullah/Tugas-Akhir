<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EnergiLog;
use Carbon\Carbon;

class EnergiLogSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 30; $i++) {
            $kwh = round(mt_rand(50, 1000) / 100, 2); // hasil antara 0.50 - 10.00

            // Menentukan level fuzzy berdasarkan nilai kwh
            if ($kwh <= 3.05) {
                $fuzzy = 'Rendah';
            } elseif ($kwh <= 5.34) {
                $fuzzy = 'Sedang';
            } else {
                $fuzzy = 'Tinggi';
            }

            EnergiLog::create([
                'tanggal' => Carbon::now()->subDays(30 - $i)->format('Y-m-d'),
                'kwh' => $kwh,
                'fuzzy' => $fuzzy,
            ]);
        }
    }
}
