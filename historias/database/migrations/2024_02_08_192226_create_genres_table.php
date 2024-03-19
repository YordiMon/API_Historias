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
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $genres = [
            'Fantasía',
            'Ciencia ficción',
            'Misterio',
            'Romance',
            'Aventura',
            'Terror',
            'Drama',
            'Histórico',
            'Comedia',
            'Acción',
            'Thriller',
            'Suspense',
            'Infantil',
            'Juvenil',
            'Realismo mágico',
            'Distopía',
            'Western',
            'Biografía',
            'Autobiografía',
            'Novela gráfica',
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre,
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
        Schema::dropIfExists('genres');
    }
};
