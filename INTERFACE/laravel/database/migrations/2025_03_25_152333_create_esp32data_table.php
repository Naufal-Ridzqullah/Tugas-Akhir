<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('esp32data', function (Blueprint $table) {
            $table->id(); // Auto increment primary key
            $table->dateTime('waktu')->default(DB::raw('CURRENT_TIMESTAMP')); // Waktu dengan default current timestamp
            $table->float('Voltage');
            $table->float('Current');
            $table->float('Power');
            $table->float('Energy');
            $table->float('Frequency');
            $table->float('PowerFactor');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('esp32data');
    }
};
