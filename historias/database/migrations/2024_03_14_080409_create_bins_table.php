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
        Schema::create('bins', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('history_id');
            $table->timestamps();
        });

        // Agregar las historias 18, 19 y 20 a la papelera de reciclaje del usuario con ID 1
        $userId = 1;
        $historyIds = [18, 19, 20];

        foreach ($historyIds as $historyId) {
            DB::table('bins')->insert([
                'user_id' => $userId,
                'history_id' => $historyId,
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
        Schema::dropIfExists('bins');
    }
};
