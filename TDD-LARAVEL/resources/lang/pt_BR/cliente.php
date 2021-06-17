<?php

return [
    'validation' => [
        'dt_situacao.date_format' => 'O formato do campo dt_situacao está inválido',
        'nu_telefone.max' => 'O campo nu_telefone não permite essa quantidade de digitos',
        'nu_celular.max' => 'O campo nu_celular não permite essa quantidade de digitos',
        'ds_razao_social.max' => 'O campo ds_razao_social não permite essa quantidade de digitos',
        'ds_nome_fantasia.max' => 'O campo ds_nome_fantasia não permite essa quantidade de digitos',
        'nu_documento.max' => 'O campo nu_documento não permite essa quantidade de digitos',
        'dt_cadastro_cerc.date_format' => 'O formato do campo dt_cadastro_cerc está inválido',
        'nu_telefone.min' => 'A quantidade de dititos minimas para o campo nu_telefone é 8',
        'nu_celular.min' => 'A quantidade de digitos minimos para o campo nu_celular é 9',
    ],
    'invalid_fields' => ['nu_codigo' => 'MSG001', 'ds_mensagem' => 'Campos inválidos'],
    'forbidden' => ['nu_codigo' => 'MSG003', 'ds_mensagem' => 'Você não tem permissão para acessar esse sistema'],
];
