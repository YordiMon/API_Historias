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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('title_id')->constrained('titles');
            $table->foreignId('content_id')->constrained('contents');
            $table->foreignId('genre_id')->constrained('genres');
            $table->foreignId('date_id')->constrained('dates');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('synopsis_id')->constrained('synopses');
            $table->timestamps();
        });

        for ($i = 1; $i <= 20; $i++) {
            DB::table('histories')->insert([
                'title_id' => $i,
                'content_id' => $i,
                'genre_id' => $i,
                'date_id' => $i,
                'user_id' => $i,
                'synopsis_id' => $i,
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
        Schema::dropIfExists('histories');
    }
};
