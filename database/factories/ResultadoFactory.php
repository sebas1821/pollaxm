<?php

namespace Database\Factories;

use App\Models\Resultado;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ResultadoFactory extends Factory
{
    protected $model = Resultado::class;

    public function definition()
    {
        return [
			'partido' => $this->faker->name,
			'golesLocal' => $this->faker->name,
			'golesVisitante' => $this->faker->name,
			'ganador' => $this->faker->name,
        ];
    }
}
