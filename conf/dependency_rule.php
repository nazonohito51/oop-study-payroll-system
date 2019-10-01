<?php

return [
    'layer rule' => [
        'Application' => [
            'define' => ['\PayrollSystem\Application\\'],
            'description' => 'Application layer',
        ],
        'Domain' => [
            'define' => ['\PayrollSystem\Domain\\'],
            'description' => 'Domain layer',
            'depender' => ['Application'],
        ],
    ],
    '<error>Mutable使うんじゃねぇ、殺すぞ 😇</error>' => [
        'PayrollSystem' => [
            'define' => ['\PayrollSystem\\', '\Tests\\'],
            'description' => 'This application',
        ],
        'Carbon' => [
            'define' => ['\Carbon\Carbon'],
            'description' => 'Carbon(mutable)',
            'depender' => ['!PayrollSystem'],
        ],
        'DateTime' => [
            'define' => ['\DateTime'],
            'description' => 'DateTime(mutable)',
            'depender' => ['!PayrollSystem'],
        ],
    ]
];
