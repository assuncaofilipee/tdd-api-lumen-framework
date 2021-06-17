<?php

namespace Database\Factories;

use App\Models\Pos;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class PosFactory extends Factory
{
    protected $model = Pos::class;
    protected $fakerNamePos = ['pax', 'pac','gertec','az'];
    protected $fakerModelPos = ['200', '2000','150','3000'];

    public function definition(): array
    {
    	return [
            'nm_pos' => Arr::random($this->fakerNamePos),
            'nm_modelo' => Arr::random($this->fakerModelPos),
            'nm_terminal' => $this->faker->randomNumber(9),
            'nr_serie' => $this->faker->randomNumber(9),
            'nu_pos' => $this->faker->randomNumber(9),
            'deleted_at' => null,
            'id_cliente' => null,
            'id_distribuidor' => null,
            'id_pos_aplicativo' => null,
            'id_pos_situacao' => null
    	];
    }
}
