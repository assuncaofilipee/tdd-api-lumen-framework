<?php

return [
    'auth.store' => [
            'name' => ['convert' => '', 'format' => [],'validation'=> ['required','string','min:3']],
            'email' => ['convert' => '', 'format' => [],'validation'=> ['required','email','unique:users']],
            'password' => ['convert' => '', 'format' => [],'validation'=> ['required','min:6']],
            'status' => ['convert' => '', 'format' => [],'validation'=> ['required','string'],'default' => 'ativo'],
        ],
    'auth.login' => [
        'email' => ['convert' => '', 'format' => [],'validation'=> ['required','email']],
        'password' => ['convert' => '', 'format' => [],'validation'=> ['required','min:6']],
    ]
];
