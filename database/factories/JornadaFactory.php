<?php

namespace Database\Factories;

use App\Models\Jornada;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JornadaFactory extends Factory
{
    protected $model = Jornada::class;

    public function definition()
    {
        return [
			'descripcion' => $this->faker->name,
			'valor_puntaje_me' => $this->faker->name,
			'valor_puntaje_g' => $this->faker->name,
        ];
    }
}
