<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('luas_bangunan', function (Blueprint $table) {
            $table->id();
            $table->float('luas');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('luas_bangunan');
    }
};
