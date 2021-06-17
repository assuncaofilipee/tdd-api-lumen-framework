<?php

return [
    'validation' => [
        'nm_pos.max' => 'O campo nm_pos não permite essa quantidade de digitos',
        'nm_modelo.max' => 'O campo nm_modelo não permite essa quantidade de digitos',
        'nm_terminal.max' => 'O campo nm_terminal não permite essa quantidade de digitos',
        'nr_serie.max' => 'O campo nr_serie não permite essa quantidade de digitos',
        'nu_pos.max' => 'O campo nu_pos não permite essa quantidade de digitos',
        'id_pos_situacao.max' => 'O campo id_pos_situacao não permite essa quantidade de digitos',
        'id_distribuidor.max' => 'O campo id_distribuidor não permite essa quantidade de digitos',
        'id_cliente.max' => 'O campo id_cliente não permite essa quantidade de digitos',
        'id_pos_aplicativo.max' => 'O campo id_pos_aplicativo não permite essa quantidade de digitos',
        'nm_terminal.required' => 'O campo nm_terminal é obrigatorio',
        'nr_serie.required' => 'O campo nr_serie é obrigatorio',
        'id_pos_situacao.exists' => 'A situação não encontrada',
        'id_distribuidor.exists' => 'Distribuidor não encontrado',
        'id_cliente.exists'            => 'Cliente não encontrado',
        'id_pos_aplicativo.exists' => 'Aplicativo não encontrado'
    ],
    'invalid_fields' => ['nu_codigo' => 'MSG001', 'ds_mensagem' => 'Campos inválidos', 'fields' => []],
    'forbidden'=> ['code' => 'MSG002', 'ds_mensagem' => 'Você não tem permissão para acessar esse sistema'],
];
