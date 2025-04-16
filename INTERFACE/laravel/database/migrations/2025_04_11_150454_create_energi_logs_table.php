<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnergiLogsTable extends Migration
{
    public function up(): void
    {
        Schema::create('energi_logs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->float('kwh');
            $table->string('fuzzy'); // "Rendah", "Sedang", "Tinggi"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('energi_logs');
    }
}
