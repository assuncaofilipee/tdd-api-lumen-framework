<?php

return [
    'situacao.store' => [
        'nm_pos_situacao' => ['convert' => '', 'format' => [],'validation'=> ['required','max:50'],
            ]
        ],
    'situacao.update' => [
        'nm_pos_situacao' => ['convert' => '', 'format' => [],'validation'=> ['required','max:50','exists:pos_situacao'],
        ],
    ]
];
