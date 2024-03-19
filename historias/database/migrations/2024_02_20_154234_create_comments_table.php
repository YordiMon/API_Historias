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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->integer('user_id');
            $table->integer('history_id');
            $table->timestamps();
        });

        // Obtener los IDs de las historias del 1 al 14
        $historyIds = range(1, 14);

        // Generar 100 comentarios coherentes
        for ($i = 0; $i < 100; $i++) {
            // Seleccionar aleatoriamente un ID de historia excluyendo los del 15 al 20
            $historyId = $this->getRandomHistoryId($historyIds);

            // Generar un comentario coherente
            $comment = $this->generateComment();

            // Insertar el comentario con el ID de historia seleccionado
            DB::table('comments')->insert([
                'comment' => $comment,
                'user_id' => mt_rand(1, 20), // Suponiendo que hay 20 usuarios
                'history_id' => $historyId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Retorna un ID de historia aleatorio, excluyendo los IDs del 15 al 20.
     *
     * @param array $historyIds
     * @return int
     */
    private function getRandomHistoryId(array $historyIds): int
    {
        // Filtrar los IDs de historia excluyendo los del 15 al 20
        $validHistoryIds = array_filter($historyIds, function ($id) {
            return $id < 15 || $id > 20;
        });

        // Obtener un ID aleatorio de la lista filtrada
        return $validHistoryIds[array_rand($validHistoryIds)];
    }

    /**
     * Genera un comentario coherente.
     *
     * @return string
     */
    private function generateComment(): string
    {
        $comments = [
            '¡Qué emocionante!',
            'No puedo esperar para ver qué pasa a continuación.',
            'Estoy enganchado a esta historia.',
            '¡Qué giro inesperado!',
            'Excelente narrativa, estoy completamente absorbido.',
            'Me encanta cómo se están desarrollando los personajes.',
            'Este capítulo me dejó sin aliento.',
            'No puedo evitar sentirme identificado con el protagonista.',
            'Estoy al borde de mi asiento.',
            'Nunca me canso de leer esta historia.',
            'Me encanta el mundo que has creado.',
            'No puedo dejar de leer.',
            '¡Qué cliffhanger!',
            'Cada capítulo es mejor que el anterior.',
            'Estoy completamente inmerso en esta historia.',
            'No puedo creer que haya pasado eso.',
            'Estoy realmente impresionado por tu habilidad para contar historias.',
            'Estoy ansioso por ver cómo se desarrolla la trama.',
            'Este es el mejor libro que he leído en mucho tiempo.',
            'Me siento como si estuviera viviendo esta historia.',
        ];

        return $comments[array_rand($comments)];
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
