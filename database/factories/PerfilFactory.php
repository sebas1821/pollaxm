<?php

namespace Database\Factories;

use App\Models\Perfil;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PerfilFactory extends Factory
{
    protected $model = Perfil::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
        ];
    }
}
