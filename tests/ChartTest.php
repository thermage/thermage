<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Base\Theme;
use Termage\Components\Chart;

beforeEach(function() {
   $this->data = [
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
            'label' => 'Apple',
            'value' => 220,
            'color' => 'green',
        ],
    ];
});

test('test termage chart method', function (): void {
    $this->assertInstanceOf(Chart::class, termage()->chart());
});

test('test chart horizontal', function (): void {
    $value = termage()->chart()->data($this->data)->horizontal()->render();
    $chart = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][color=red][p l=0 r=3]Apple[/p][/color][/m][m l=0 r=0][bg=red][p l=0 r=0]                 [/p][/bg][/m][m l=0 r=0][color=orange][p l=0 r=2]Orange[/p][/color][/m][m l=0 r=0][bg=orange][p l=0 r=0]                                              [/p][/bg][/m][m l=0 r=0][color=green][p l=0 r=3]Apple[/p][/color][/m][m l=0 r=0][bg=green][p l=0 r=0]                                     [/p][/bg][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($chart);
});

test('test chart inline', function (): void {
    $value = termage()->chart()->data($this->data)->inline()->render();
    $chart = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][bg=red][p l=0 r=0]                 [/p][/bg][/m][m l=0 r=0][bg=orange][p l=0 r=0]                                              [/p][/bg][/m][m l=0 r=0][bg=green][p l=0 r=0]                                     [/p][/bg][/m][m l=0 r=0][color=red][p l=0 r=0]Apple [/p][/color][/m][m l=0 r=0][color=orange][p l=0 r=0]Orange [/p][/color][/m][m l=0 r=0][color=green][p l=0 r=0]Apple [/p][/color][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($chart);
});