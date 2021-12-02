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

$argv[1] ??= 'inline';


switch ($argv[1]) {
    case 'horizontal':
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
                ->horizontal()
                ->bThin()
                ->showPercents()
                ->showValues()
        );
        
        
        echo PHP_EOL;
        
        echo (
            chart()
                ->data($data)
                ->horizontal()
                ->bHeavy()
                ->showPercents()
                ->showValues()
        );
        
        echo PHP_EOL;
        
        echo (
            chart()
                ->data($data)
                ->horizontal()
                ->bSuperHeavy()
                ->showPercents()
                ->showValues()
        );
        
        echo PHP_EOL;
        
        echo (
            chart()
                ->data($data)
                ->horizontal()
                ->bDouble()
                ->showPercents()
                ->showValues()
        );
        
        echo PHP_EOL;
        
        echo (
            chart()
                ->data($data)
                ->horizontal()
                ->bTriple()
                ->showPercents()
                ->showValues()
        );
        
        echo PHP_EOL;
        
        echo (
            chart()
                ->data($data)
                ->horizontal()
                ->bRopeHeavy()
                ->showPercents()
                ->showValues()
        );
        
        echo PHP_EOL;
        
        echo (
            chart()
                ->data($data)
                ->horizontal()
                ->bNoise()
                ->showPercents()
                ->showValues()
        );
        break;
    case 'inline':
    default:
        echo (
            chart()
                ->data($data)
                ->inline()
                ->showPercents()
                ->showValues()
        );
        
        echo PHP_EOL;
        
        echo (
            chart()
                ->data($data)
                ->inline()
                ->bThin()
                ->showPercents()
                ->showValues()
        );
        
        
        echo PHP_EOL;
        
        echo (
            chart()
                ->data($data)
                ->inline()
                ->bHeavy()
                ->showPercents()
                ->showValues()
        );
        
        echo PHP_EOL;
        
        echo (
            chart()
                ->data($data)
                ->inline()
                ->bSuperHeavy()
                ->showPercents()
                ->showValues()
        );
        
        
        echo PHP_EOL;
        
        echo (
            chart()
                ->data($data)
                ->inline()
                ->bDouble()
                ->showPercents()
                ->showValues()
        );
        
        echo PHP_EOL;
        
        echo (
            chart()
                ->data($data)
                ->inline()
                ->bTriple()
                ->showPercents()
                ->showValues()
        );
        
        echo PHP_EOL;
        
        echo (
            chart()
                ->data($data)
                ->inline()
                ->bRopeHeavy()
                ->showPercents()
                ->showValues()
        );
        
        echo PHP_EOL;
        
        echo (
            chart()
                ->data($data)
                ->inline()
                ->bNoise()
                ->showPercents()
                ->showValues()
        );
        break;
}