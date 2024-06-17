<?php

namespace Database\Factories;

use App\Models\Pronostico;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PronosticoFactory extends Factory
{
    protected $model = Pronostico::class;

    public function definition()
    {
        return [
			'jugador' => $this->faker->name,
			'partido' => $this->faker->name,
			'golesLocal' => $this->faker->name,
			'golesVisitante' => $this->faker->name,
			'ganador' => $this->faker->name,
        ];
    }
}
