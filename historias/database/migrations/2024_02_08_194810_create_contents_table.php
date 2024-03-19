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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->timestamps();
        });

        $contents = [
            'El protagonista despierta en un lugar desconocido, rodeado de oscuridad. Debe encontrar una salida antes de que sea demasiado tarde.',
            'Después de escapar del peligro inmediato, el protagonista se encuentra con un extraño personaje que ofrece ayuda. ¿Debería confiar en él?',
            'El protagonista descubre una pista que podría llevarlo más cerca de su objetivo. Pero el camino está lleno de peligros y decisiones difíciles.',
            'Una nueva amenaza aparece, poniendo en peligro todo lo que el protagonista ha luchado por alcanzar. ¿Cómo responderá a este desafío?',
            'Las decisiones del protagonista tienen consecuencias inesperadas, cambiando el curso de la historia de formas impredecibles.',
            'Con el tiempo agotándose, el protagonista debe tomar una decisión crucial que determinará su destino. ¿Cuál será su elección?',
            'Dos caminos se abren ante el protagonista, cada uno con su propio conjunto de desafíos y recompensas. ¿Cuál elegirá?',
            'En un giro inesperado, el protagonista descubre la verdad detrás de su misión y debe enfrentarse a un dilema moral que cambiará su vida para siempre.',
            'La batalla final se acerca, y el protagonista debe reunir todas sus fuerzas y aliados para enfrentarse al enemigo definitivo.',
            'Con el destino del mundo en juego, el protagonista se enfrenta a su mayor desafío hasta ahora. ¿Logrará salir victorioso?',
            'El epílogo revela las consecuencias de las decisiones del protagonista y ofrece un vistazo al futuro incierto que aguarda.',
            'En una historia llena de giros y vueltas, el protagonista finalmente encuentra la paz que tanto anhelaba, pero a qué costo?',
            'Un final alternativo revela un destino completamente diferente para el protagonista, desafiando todas las expectativas.',
            'Los secretos enterrados finalmente salen a la luz, cambiando la percepción de todo lo que el protagonista creía saber.',
            'Con el corazón lleno de esperanza, el protagonista se embarca en una nueva aventura, dejando atrás el pasado y mirando hacia el futuro.',
            'En un mundo lleno de posibilidades, el protagonista encuentra la libertad que tanto ansiaba, pero también la responsabilidad que conlleva.',
            'Un giro inesperado de los acontecimientos lleva al protagonista por un camino desconocido, desafiando todas sus expectativas y prejuicios.',
            'En un momento de claridad, el protagonista comprende el verdadero significado de su viaje y encuentra la fuerza para seguir adelante.',
            'Con el destino en sus manos, el protagonista se enfrenta a su mayor miedo y descubre que la verdadera fuerza proviene del interior.',
            'En el último acto de su historia, el protagonista toma una decisión que cambiará el curso de su vida para siempre, para bien o para mal.',
        ];

        foreach ($contents as $content) {
            DB::table('contents')->insert([
                'content' => $content,
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
        Schema::dropIfExists('contents');
    }
};
