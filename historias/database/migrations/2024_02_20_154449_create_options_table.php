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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('branch_title');
            $table->text('branch_content');
            $table->integer('history_id');
            $table->timestamps();
        });

        // Ramas coherentes para cada historia
        $branches = [
            // Historia 1
            [
                'title' => 'Rama A',
                'content' => 'El protagonista decide enfrentar al villano sin ayuda. Aunque valiente, su falta de apoyo lo hace vulnerable y sufre una derrota devastadora. Después de este revés, el protagonista se ve obligado a replantear su enfoque y buscar aliados para luchar contra el mal.',
                'history_id' => 1,
            ],
            [
                'title' => 'Rama B',
                'content' => 'El protagonista reúne a sus aliados y juntos planean un ataque estratégico contra el villano. Su trabajo en equipo y planificación meticulosa los lleva a la victoria, asegurando un futuro próspero para todos. Tras la batalla, el protagonista celebra su triunfo, sabiendo que la verdadera fuerza reside en la unidad.',
                'history_id' => 1,
            ],

            // Historia 2
            [
                'title' => 'Rama A',
                'content' => 'El protagonista elige confiar en el extraño y sigue sus indicaciones. Sin embargo, resulta ser una trampa y cae en manos del enemigo. Atrapado y sin esperanza, el protagonista se enfrenta a su captor con valentía, pero su destino parece sellado.',
                'history_id' => 2,
            ],
            [
                'title' => 'Rama B',
                'content' => 'El protagonista decide confiar en su instinto y seguir su propio camino. A pesar de los desafíos, logra encontrar una salida y continúa su búsqueda con determinación. Con cada obstáculo superado, el protagonista se fortalece y se acerca un paso más a su objetivo.',
                'history_id' => 2,
            ],

            // Continuar con el patrón para las demás historias...
        ];

        // Insertar las ramas en la tabla
        foreach ($branches as $branch) {
            DB::table('branches')->insert([
                'branch_title' => $branch['title'],
                'branch_content' => $branch['content'],
                'history_id' => $branch['history_id'],
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
        Schema::dropIfExists('branches');
    }
};
