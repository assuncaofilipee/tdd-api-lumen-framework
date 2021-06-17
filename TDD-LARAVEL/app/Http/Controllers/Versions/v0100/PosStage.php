<?php

return [
    'pos.store' => [
        'nm_pos' => ['convert' => '', 'format' => [],'validation'=> ['max:50']],
        'nm_modelo' => ['convert' => '', 'format' => [],'validation'=> ['max:50']],
        'nm_terminal' => ['convert' => '', 'format' => [],'validation'=> ['required','max:25']],
        'nr_serie' => ['convert' => '', 'format' => [],'validation'=> ['required','max:100']],
        'nu_pos' => ['convert' => '', 'format' => [],'validation'=> ['max:100']],
        'id_pos_situacao' => ['convert' => '', 'format' => [],'validation'=> ['max:100','nullable','exists:pos_situacao']],
        'id_distribuidor' => ['convert' => '', 'format' => [],'validation'=> ['max:100','nullable','exists:distribuidor']],
        'id_cliente' => ['convert' => '', 'format' => [],'validation'=> ['max:100','nullable','exists:cliente']],
        'id_pos_aplicativo' => ['convert' => '', 'format' => [],'validation'=> ['max:100','nullable','exists:pos_aplicativo']]
    ],
    'pos.update' => [
        'nm_pos' => ['convert' => '', 'format' => [],'validation'=> ['max:50']],
        'nm_modelo' => ['convert' => '', 'format' => [],'validation'=> ['max:50']],
        'nm_terminal' => ['convert' => '', 'format' => [],'validation'=> ['max:25']],
        'nr_serie' => ['convert' => '', 'format' => [],'validation'=> ['max:100']],
        'nu_pos' => ['convert' => '', 'format' => [],'validation'=> ['max:100']],
        'id_pos_situacao' => ['convert' => '', 'format' => [],'validation'=> ['max:100','nullable','exists:pos_situacao']],
        'id_distribuidor' => ['convert' => '', 'format' => [],'validation'=> ['max:100','nullable','exists:distribuidor']],
        'id_cliente' => ['convert' => '', 'format' => [],'validation'=> ['max:100','nullable','exists:cliente']],
        'id_pos_aplicativo' => ['convert' => '', 'format' => [],'validation'=> ['max:100','nullable','exists:pos_aplicativo']]
    ]
];

