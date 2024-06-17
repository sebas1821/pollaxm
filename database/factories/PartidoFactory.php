<?php

namespace Database\Factories;

use App\Models\Partido;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PartidoFactory extends Factory
{
    protected $model = Partido::class;

    public function definition()
    {
        return [
			'idEquipoLocal' => $this->faker->name,
			'idEquipoVisitante' => $this->faker->name,
        ];
    }
}
