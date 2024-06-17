<?php

namespace Database\Factories;

use App\Models\Jugadore;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JugadoreFactory extends Factory
{
    protected $model = Jugadore::class;

    public function definition()
    {
        return [
			'nombres' => $this->faker->name,
			'apellidos' => $this->faker->name,
			'identificacion' => $this->faker->name,
			'celular' => $this->faker->name,
			'email' => $this->faker->name,
			'idPerfil' => $this->faker->name,
        ];
    }
}
