<?php

return [
    'cliente' => [
        'dt_situacao' => ['convert' => '', 'format' => [],'validation'=> ['date_format:Y-m-d H:i:s']],
        'nu_telefone' => ['convert' => '', 'format' => [],'validation'=> ['min:8','max:20']],
        'nu_celular' => ['convert' => '', 'format' => [],'validation'=> ['min:8','max:20']],
        'ds_razao_social' => ['convert' => '', 'format' => [],'validation'=> ['max:200']],
        'ds_nome_fantasia' => ['convert' => '', 'format' => [],'validation'=> ['max:200']],
        'nu_documento' => ['convert' => '', 'format' => [],'validation'=> ['max:20']],
        'dt_cadastro_cerc' => ['convert' => '', 'format' => [],'validation'=> ['date_format:"Y-m-d H:i:s']],
    ],
];
