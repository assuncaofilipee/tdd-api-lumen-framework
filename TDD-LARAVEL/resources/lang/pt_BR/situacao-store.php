<?php

return [
    'validation' => [
        'nm_pos_situacao.required' => 'O campo nm_pos_situacao é obrigatorio',
        'nm_pos_situacao.max' => 'O campo nm_pos_situacao não permite essa quantidade de digitos',
    ],
    'invalid_fields' => ['nu_codigo' => 'MSG001', 'ds_mensagem' => 'Campos inválidos','fields' => []],
    'forbidden' => ['nu_codigo' => 'MSG002', 'ds_mensagem' => 'Você não tem permissão para acessar esse sistema'],
];
