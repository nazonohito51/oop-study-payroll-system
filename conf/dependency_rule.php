<?php

return [
    'layer rule' => [
        'Application' => [
            'define' => ['\SalarySystem\Application\\'],
            'description' => 'Application layer',
        ],
        'Domain' => [
            'define' => ['\SalarySystem\Domain\\'],
            'description' => 'Domain layer',
            'depender' => ['Application'],
        ],
    ],
    'datetime must be immutable' => [
        'SalarySystem' => [
            'define' => ['\SalarySystem\\', '\Tests\\'],
            'description' => 'This application',
        ],
        'Carbon' => [
            'define' => ['\Carbon\Carbon'],
            'description' => 'Carbon(mutable)',
            'depender' => ['!SalarySystem'],
        ],
        'DateTime' => [
            'define' => ['\DateTime'],
            'description' => 'DateTime(mutable)',
            'depender' => ['!SalarySystem'],
        ],
    ]
];
