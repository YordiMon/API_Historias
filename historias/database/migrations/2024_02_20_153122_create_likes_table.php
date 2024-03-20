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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->integer('history_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        $historyIds = range(1, 14);
        $userIds = range(1, 20);

        for ($i = 0; $i < 100; $i++) {
            $historyId = $this->getRandomHistoryId($historyIds);
            $userId = $this->getRandomUserId($userIds);

            DB::table('likes')->insert([
                'history_id' => $historyId,
                'user_id' => $userId,
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
        $validHistoryIds = array_filter($historyIds, function ($id) {
            return $id < 15 || $id > 20;
        });

        return $validHistoryIds[array_rand($validHistoryIds)];
    }

    /**
     * Retorna un ID de usuario aleatorio, excluyendo los IDs del 21 en adelante.
     *
     * @param array $userIds
     * @return int
     */
    private function getRandomUserId(array $userIds): int
    {
        $validUserIds = array_filter($userIds, function ($id) {
            return $id <= 20;
        });

        return $validUserIds[array_rand($validUserIds)];
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
