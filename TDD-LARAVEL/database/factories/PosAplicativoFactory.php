<?php

namespace Database\Factories;

use App\Models\PosAplicativo;
use Illuminate\Database\Eloquent\Factories\Factory;
class PosAplicativoFactory extends Factory
{
    protected $model = PosAplicativo::class;
    protected $fakerPos = ['cielo', 'alibin', 'paypal', 'mercadopago'];

    public function definition() : array
    {
        return [
                'nm_pos_aplicativo' => array_rand($this->fakerPos),
                'nr_versao' => 1,
                'tp_principal' =>  $this->faker->boolean(),
                'deleted_at' => null
            ];
    }
}
