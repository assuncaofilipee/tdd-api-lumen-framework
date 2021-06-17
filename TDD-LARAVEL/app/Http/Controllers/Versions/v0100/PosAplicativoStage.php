<?php

return [
    'aplicativo.store' => [
        'nm_pos_aplicativo' => ['convert' => '', 'format' => [],'validation'=> ['max:50']],
        'nr_versao' => ['convert' => '', 'format' => [],'validation'=> ['max:15']],
        'tp_principal' => ['convert' => '', 'format' => [],'validation'=> ['boolean'],'default' => false],
    ],
    'aplicativo.update' => [
        'nm_pos_aplicativo' => ['convert' => '', 'format' => [],'validation'=> ['max:50']],
        'nr_versao' => ['convert' => '', 'format' => [],'validation'=> ['max:15']],
        'tp_principal' => ['convert' => '', 'format' => [],'validation'=> ['boolean']],
    ]
];

