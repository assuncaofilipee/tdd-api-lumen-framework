<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition() : array
    {
    	return [
            'dt_situacao' => $this->faker->date('Y-m-d H:i:s'),
            'nu_telefone' => $this->faker->randomNumber(9),
            'nu_celular' => $this->faker->randomNumber(9),
            'nm_cliente' => $this->faker->name,
            'ds_razao_social' => $this->faker->randomNumber(9),
            'ds_nome_fantasia' => $this->faker->company,
            'nu_documento' => $this->faker->randomNumber(9),
            'dt_cadastro_cerc' => $this->faker->date('Y-m-d H:i:s'),
            'email' => $this->faker->email,
            'deleted_at' => null
    	];
    }
}
