<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Themes\Theme;
use Termage\Themes\ThemeInterface;
use Atomastic\Arrays\Arrays as Collection;
use function arrays as collection;
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

test('test horizontal', function (): void {
    $value = chart()->data($this->data)->horizontal()->render();
    $chart = "\e[31mApple\e[39m\e[41m\e[49m\e[33mOrange\e[39m\e[43m\e[49m\e[32mLime\e[39m\e[42m\e[49m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($chart);
});

test('test inline', function (): void {
    $value = chart()->data($this->data)->inline()->render();
    $chart = "\e[41m\e[49m\e[43m\e[49m\e[42m\e[49m\e[31mApple\e[39m\e[33mOrange\e[39m\e[32mLime\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($chart);
});

test('test showPercents', function (): void {
    $value = chart()->data($this->data)->showPercents()->render();
    $chart = "\e[31mApple\e[39m\e[41m\e[49m\e[31m17%\e[39m\e[33mOrange\e[39m\e[43m\e[49m\e[33m46%\e[39m\e[32mLime\e[39m\e[42m\e[49m\e[32m37%\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($chart);
});

test('test showValues', function (): void {
    $value = chart()->data($this->data)->showValues()->render();
    $chart = "\e[31mApple\e[39m\e[41m\e[49m\e[31m(100)\e[39m\e[33mOrange\e[39m\e[43m\e[49m\e[33m(270)\e[39m\e[32mLime\e[39m\e[42m\e[49m\e[32m(220)\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($chart);
});

test('test valuesSufix', function (): void {
    $value = chart()->data($this->data)->showValues()->valuesSufix('items')->render();
    $chart = "\e[31mApple\e[39m\e[41m\e[49m\e[31m(100items)\e[39m\e[33mOrange\e[39m\e[43m\e[49m\e[33m(270items)\e[39m\e[32mLime\e[39m\e[42m\e[49m\e[32m(220items)\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($chart);
});

test('test getData', function (): void {
    $value = chart()->data($this->data)->getData();
    expect(serialize($value))->toEqual(serialize($this->data));
});

test('test getType', function (): void {
    $value = chart()->data($this->data)->getType();
    expect($value)->toEqual('horizontal');
});

class ChartTestTheme extends Theme implements ThemeInterface
{
    public function getThemeVariables(): Collection
    {
        return collection([
            'colors' => [
                'blue' => 'blue',
                'yellow' => 'yellow',
                'black' => 'black',
                'white' => 'white',
                'red' => 'red',
                'green' => 'green',
                'gray' => 'gray',
            ],
        ]);
    }
}