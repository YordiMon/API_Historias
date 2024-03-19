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
        Schema::create('synopses', function (Blueprint $table) {
            $table->id();
            $table->string('synopsis');
            $table->timestamps();
        });

        // Sinopsis coherentes para las historias
        $synopses = [
            'En un reino asediado por la oscuridad, un joven héroe debe emprender un viaje para encontrar la única arma capaz de derrotar al malvado hechicero que lo amenaza.',
            'Después de descubrir un antiguo mapa en el ático de su abuela, un grupo de jóvenes aventureros se embarca en una búsqueda épica para encontrar un tesoro legendario oculto durante siglos.',
            'Cuando los dragones despiertan de su largo sueño, el destino del reino está en manos de un valiente guerrero elegido por los dioses para detener su imparable avance.',
            'En una remota isla perdida en el océano, un misterioso faro guarda secretos ancestrales que solo aquellos con el coraje suficiente pueden descubrir.',
            'Una luz misteriosa brilla en el cielo, llevando a un joven campesino en un viaje de autodescubrimiento y aventura a través de tierras desconocidas y peligrosas.',
            'Una mansión abandonada esconde un oscuro secreto que amenaza con consumir a todo aquel que se atreva a entrar en sus ruinosos salones.',
            'Una antigua profecía advierte de la llegada de la Luna Roja, un evento que desatará fuerzas oscuras y pondrá a prueba el valor y la determinación de los héroes.',
            'Cuando un grupo de jóvenes se encuentra con un artefacto antiguo que otorga poderes mágicos, deben unir fuerzas para protegerlo de aquellos que desean usarlo para el mal.',
            'En un mundo lleno de hadas y criaturas mágicas, un joven aprendiz de mago se ve envuelto en una guerra ancestral entre la luz y la oscuridad.',
            'Los sueños de un reino en ruinas y un poderoso guardián olvidado llevan a un joven aventurero en un viaje para restaurar el equilibrio del mundo.',
            'Un joven príncipe debe recuperar la legendaria espada de su padre y reclamar su lugar como el verdadero heredero del trono, enfrentándose a enemigos mortales en el camino.',
            'En lo profundo del bosque encantado, los susurros de los árboles ocultan un secreto ancestral que cambiará el destino del reino para siempre.',
            'Los descendientes de los antiguos guardianes de la magia se embarcan en un peligroso viaje para reclamar sus legados y enfrentarse al mal que amenaza con destruirlo todo.',
            'Una melodía mágica lleva a un joven músico en un viaje a través de tierras desconocidas, donde descubre su verdadero destino y el poder de la música para cambiar el mundo.',
            'Un laberinto misterioso guarda el secreto de un tesoro legendario, pero solo aquellos con coraje y determinación pueden enfrentarse a sus desafíos mortales.',
            'Una llave antigua abre la puerta a un mundo de maravillas y peligros, donde un grupo de valientes aventureros se enfrenta a la prueba definitiva de su coraje.',
            'Un fénix renace de sus cenizas para guiar a un joven héroe en un viaje de autodescubrimiento y redención a través de tierras desconocidas y peligrosas.',
            'Las estrellas en el cielo nocturno guardan secretos antiguos que solo aquellos que se atreven a bailar con ellas pueden descubrir y comprender.',
            'Cuando la magia se despierta en un mundo olvidado, un joven aprendiz de mago debe enfrentarse a su destino y proteger el equilibrio del universo.',
            'En un mundo de magia y maravillas, un grupo de valientes aventureros emprende un viaje épico para salvar a su reino de la oscuridad que lo amenaza.',
        ];

        // Insertar las sinopsis en la tabla
        foreach ($synopses as $synopsis) {
            DB::table('synopses')->insert([
                'synopsis' => $synopsis,
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
        Schema::dropIfExists('synopses');
    }
};
