<?php

namespace Database\Factories;

use App\Models\PosSituacao;
use Illuminate\Database\Eloquent\Factories\Factory;

class PosSituacaoFactory extends Factory
{
    protected $model = PosSituacao::class;

    public function definition(): array
    {
    	return [
    	    'nm_pos_situacao' =>  'Ativo',
            'deleted_at' => null
    	];
    }
}
