<?php

declare(strict_types=1);

use Thermage\Thermage;
use Thermage\Themes\Theme;
use Thermage\Themes\ThemeInterface;
use Glowy\Arrays\Arrays as Collection;
use function Glowy\Arrays\arrays as collection;
use function Glowy\Strings\strings;
use function Thermage\setTheme;
use function Thermage\hr;
use function Thermage\terminal;

beforeEach(function() {
    setTheme(new HrTestTheme());
});

test('test hr', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->renderToString();
    $hr = terminal()->getCsi() . "0m───§§Stay RAD!§§────" . PHP_EOL;
    expect(strings($value)->toString())->toEqual($hr);
});

test('test hr without value', function (): void {
    putenv('COLUMNS=20');
    $value = hr()->renderToString();
    $hr = terminal()->getCsi() . "0m────────────────────" . PHP_EOL;
    expect(strings($value)->toString())->toEqual($hr);
});

test('test hr with text align left', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->textAlignLeft()->renderToString();
    $hr = terminal()->getCsi() . "0m───§§Stay RAD!§§────" . PHP_EOL;
    expect(strings($value)->toString())->toEqual($hr);
});

test('test hr with text align right', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->textAlignRight()->renderToString();
    $hr =  terminal()->getCsi() . "0m────§§Stay RAD!§§───" . PHP_EOL;
    expect(strings($value)->toString())->toEqual($hr);
});

test('test hr with text align center', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->textAlignCenter()->renderToString();
    $hr = terminal()->getCsi() . "0m────§§Stay RAD!§§───" . PHP_EOL;
    expect(strings($value)->toString())->toEqual($hr);
});

test('test hr with double border', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->borderDouble()->renderToString();
    $hr = terminal()->getCsi() . "0m═══§§Stay RAD!§§════" . PHP_EOL;
    expect(strings($value)->toString())->toEqual($hr);
});

class HrTestTheme extends Theme implements ThemeInterface
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
            'hr' => [
                'text-align' => 'left',
            ],
        ]);
    }
}