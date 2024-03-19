<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('bio')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $userBios = [
            'John Doe' => 'Amante de la tecnología y los viajes. Siempre en busca de nuevas aventuras y experiencias.',
            'Jane Smith' => 'Apasionada por la música y el arte. Soñadora y creativa, siempre buscando inspiración en su entorno.',
            'Robert Johnson' => 'Entusiasta del deporte y la vida al aire libre. Siempre activo y en movimiento.',
            'Emily Davis' => 'Adicta a los libros y las películas. Siempre dispuesta a descubrir nuevas historias y personajes.',
            'Michael Wilson' => 'Emprendedor y visionario. Siempre buscando nuevas oportunidades para crecer y aprender.',
            'Olivia Brown' => 'Amante de la cocina y la gastronomía. Siempre experimentando con nuevos sabores y recetas.',
            'David Taylor' => 'Ingeniero de software y amante del código. Siempre buscando soluciones creativas a problemas complejos.',
            'Sophia Anderson' => 'Activista y defensora de los derechos humanos. Siempre luchando por un mundo más justo y equitativo.',
            'James Miller' => 'Aventurero y explorador. Siempre listo para descubrir nuevos lugares y culturas.',
            'Ava Jackson' => 'Artista en ciernes y amante de la naturaleza. Siempre buscando inspiración en el mundo que la rodea.',
            'William Harris' => 'Fanático de los deportes y los viajes. Siempre listo para apoyar a su equipo favorito y explorar nuevos destinos.',
            'Emma White' => 'Soñadora y romántica empedernida. Siempre buscando el amor y la felicidad en cada momento.',
            'Daniel Martin' => 'Empresario y estratega. Siempre pensando en grande y buscando formas de innovar en el mundo empresarial.',
            'Isabella Clark' => 'Entusiasta de la moda y el estilo. Siempre siguiendo las últimas tendencias y creando su propio estilo único.',
            'Matthew Young' => 'Científico y curioso por naturaleza. Siempre buscando respuestas a las preguntas más difíciles y desafiantes.',
            'Grace Thomas' => 'Amante de los animales y la naturaleza. Siempre comprometida con la conservación del medio ambiente y el bienestar animal.',
            'Andrew Hall' => 'Filósofo y pensador profundo. Siempre reflexionando sobre el sentido de la vida y el universo.',
            'Chloe Turner' => 'Música y amante del arte. Siempre buscando nuevas formas de expresión y creatividad.',
            'Christopher Walker' => 'Aventurero y amante de los deportes extremos. Siempre buscando emociones fuertes y adrenalina pura.',
            'Ella Baker' => 'Espíritu libre y bohemio. Siempre siguiendo su propio camino y buscando la belleza en las cosas simples de la vida.',
            'yordi' => 'Apasionado por la tecnología y la programación. Siempre aprendiendo y experimentando con nuevas tecnologías.'
        ];

        foreach ($userBios as $userName => $bio) {
            $email = strtolower(str_replace(' ', '.', $userName)) . '@gmail.com';
            $password = Hash::make('12345678');

            DB::table('users')->insert([
                'name' => $userName,
                'email' => $email,
                'password' => $password,
                'bio' => $bio,
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
        Schema::dropIfExists('users');
    }
};
