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
        Schema::create('saved', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('history_id')->constrained('histories');
            $table->timestamps();
        });

        // Obtener IDs de historias del 1 al 14
        $historyIds = range(1, 14);

        // Obtener IDs de usuarios
        $userIds = DB::table('users')->pluck('id')->toArray();

        // Crear 20 registros en la tabla saved
        for ($i = 0; $i < 20; $i++) {
            // Seleccionar aleatoriamente un ID de usuario
            $userId = $userIds[array_rand($userIds)];

            // Seleccionar aleatoriamente un ID de historia excluyendo los del 15 al 20
            $historyId = $this->getRandomHistoryId($historyIds);

            // Insertar el registro en la tabla saved
            DB::table('saved')->insert([
                'user_id' => $userId,
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
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved');
    }
};
