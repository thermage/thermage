<?php 

use function Termage\chart;

require_once __DIR__ . '/../../vendor/autoload.php';

$data = [
    'apple' => [
        'label' => 'Apple',
        'value' => 100,
        'color' => 'red',
    ],
    'orange' => [
        'label' => 'Orange',
        'value' => 270,
        'color' => 'orange',
    ],
    'lime' => [
        'label' => 'Lime',
        'value' => 220,
        'color' => 'green',
    ],
];

echo (
    chart()
        ->data($data)
        ->horizontal()
        ->showPercents()
        ->showValues()
);

echo PHP_EOL;

echo (
    chart()
        ->data($data)
        ->inline()
        ->showPercents()
        ->showValues()
);