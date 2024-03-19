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
        Schema::create('drafts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('history_id');
            $table->timestamps();
        });

        // Agregar 3 registros de borradores con ID 1 correspondientes a las historias 15, 16 y 17
        $user_id = 1;
        $history_ids = [15, 16, 17];

        foreach ($history_ids as $history_id) {
            DB::table('drafts')->insert([
                'user_id' => $user_id,
                'history_id' => $history_id,
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
        Schema::dropIfExists('drafts');
    }
};
