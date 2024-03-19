<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dates', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->timestamps();
        });

        // Generar 20 fechas aleatorias en un rango de 3 meses antes de la fecha actual
        for ($i = 0; $i < 20; $i++) {
            $randomDate = now()->subDays(rand(1, 90));
            DB::table('dates')->insert([
                'date' => $randomDate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dates');
    }
};
