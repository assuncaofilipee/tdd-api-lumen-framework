<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosSituacaoSeeder extends Seeder
{
    protected  $status = ['Ativo','Aplicativo Instalado', 'Em Utilização', 'nova',
        'Em Reparo', 'Desativada', 'Empréstimo', 'Solicitação de Reparo'];

    public function run()
    {
        $faker = Faker::create();
        foreach ($this->status as $situacao) {
            DB::table('pos_situacao')->whereColumn('nm_pos_situacao',"!=",$situacao)->insert([
                'nm_pos_situacao' => $situacao,
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
            ]);
        }
    }
}
