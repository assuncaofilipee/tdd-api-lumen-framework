<?php

namespace Database\Factories;

use App\Models\Distribuidor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DistribuidorFactory extends Factory
{
    protected $model = Distribuidor::class;

    public function definition(): array
    {
    	return [
            'nu_telefone' => $this->faker->randomNumber(9),
            'nu_celular' => $this->faker->randomNumber(9),
            'nm_distribuidor' => $this->faker->name,
            'ds_razao_social' => $this->faker->randomNumber(9),
            'ds_nome_fantasia' => $this->faker->company,
            'nu_documento' => $this->faker->randomNumber(9),
            'deleted_at' => null
    	];
    }
}
