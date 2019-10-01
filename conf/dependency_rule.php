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
    'datetime must be immutable' => [
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
