<?php

return [
    'validation' => [
        'nm_pos_aplicativo.max' => 'O campo nm_pos_aplicativo não permite essa quantidade de digitos',
        'nr_versao.max' => 'O campo nr_versao não permite essa quantidade de digitos',
        'tp_principal.boolean' => 'O campo tp_principal deve do tipo verdadeiro ou falso',
    ],
    'invalid_fields' => ['nu_codigo' => 'MSG001', 'ds_mensagem' => 'Campos inválidos','fields' => []],
    'forbidden' => ['nu_codigo' => 'MSG002', 'ds_mensagem' => 'Você não tem permissão para acessar esse sistema'],
];
