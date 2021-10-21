<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Themes\Theme;
use Termage\Themes\ThemeInterface;
use Termage\Elements\Chart;
use function Termage\chart;
use function Termage\setTheme;

beforeEach(function() {
    setTheme(new ChartTestTheme());

    $this->data = [
        'apple' => [
            'label' => 'Apple',
            'value' => 100,
            'color' => 'red',
        ],
        'orange' => [
            'label' => 'Orange',
            'value' => 270,
            'color' => 'yellow',
        ],
        'lime' => [
            'label' => 'Lime',
            'value' => 220,
            'color' => 'green',
        ],
    ];
});

test('test chart horizontal', function (): void {
    $value = chart()->data($this->data)->horizontal()->render();
    $chart = "\e[31mApple\e[39m\e[41m\e[49m\e[33mOrange\e[39m\e[43m\e[49m\e[32mLime\e[39m\e[42m\e[49m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($chart);
});

test('test chart inline', function (): void {
    $value = chart()->data($this->data)->horizontal()->render();
    $chart = "\e[31mApple\e[39m\e[41m\e[49m\e[33mOrange\e[39m\e[43m\e[49m\e[32mLime\e[39m\e[42m\e[49m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($chart);
});

class ChartTestTheme extends Theme implements ThemeInterface
{
    public function getThemeVariables(): array
    {
        return [
            'colors' => [
                'blue' => 'blue',
                'yellow' => 'yellow',
                'black' => 'black',
                'white' => 'white',
                'red' => 'red',
                'green' => 'green',
                'gray' => 'gray',
            ],
        ];
    }
}