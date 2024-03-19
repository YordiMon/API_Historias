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
        Schema::create('titles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        $titles = [
            'El último suspiro del reino',
            'Sombras en la oscuridad',
            'El despertar de los dragones',
            'La búsqueda del tesoro perdido',
            'El secreto del viejo faro',
            'El viaje de la luz',
            'El misterio de la mansión abandonada',
            'La profecía de la Luna Roja',
            'El destino de los elegidos',
            'El pacto de las hadas',
            'El guardián de los sueños',
            'La espada del rey caído',
            'Los susurros del bosque encantado',
            'El legado de los antiguos',
            'La canción del viento',
            'El laberinto de las sombras',
            'La llave de la eternidad',
            'El vuelo del fénix',
            'La danza de las estrellas',
            'El despertar de la magia',
        ];

        // Insertar los títulos en la tabla
        foreach ($titles as $title) {
            DB::table('titles')->insert([
                'title' => $title,
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
        Schema::dropIfExists('titles');
    }
};
