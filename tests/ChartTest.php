<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Themes\Theme;
use Termage\Elements\Chart;
use function Termage\chart;

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
            'label' => 'Lime',
            'value' => 220,
            'color' => 'green',
        ],
    ];
});

test('test chart horizontal', function (): void {
    $value = chart()->setData($this->data)->horizontal()->render();
    $chart = "\e[38;2;220;53;69mApple\e[39m\e[48;2;220;53;69m\e[49m\e[38;2;253;126;20mOrange\e[39m\e[48;2;253;126;20m\e[49m\e[38;2;40;167;69mLime\e[39m\e[48;2;40;167;69m\e[49m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($chart);
});

test('test chart inline', function (): void {
    $value = chart()->setData($this->data)->horizontal()->render();
    $chart = "\e[38;2;220;53;69mApple\e[39m\e[48;2;220;53;69m\e[49m\e[38;2;253;126;20mOrange\e[39m\e[48;2;253;126;20m\e[49m\e[38;2;40;167;69mLime\e[39m\e[48;2;40;167;69m\e[49m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($chart);
});