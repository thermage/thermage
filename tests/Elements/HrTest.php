<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Themes\Theme;
use Termage\Themes\ThemeInterface;
use Atomastic\Arrays\Arrays as Collection;
use function arrays as collection;
use function Termage\setTheme;
use function Termage\hr;

beforeEach(function() {
    setTheme(new HrTestTheme());
});

test('test hr', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->render();
    $hr = "\e[0m───  Stay RAD!  ────" . PHP_EOL;
    expect(strings($value)->toString())->toEqual($hr);
});

test('test hr without value', function (): void {
    putenv('COLUMNS=20');
    $value = hr()->render();
    $hr = "\e[0m────────────────────" . PHP_EOL;
    expect(strings($value)->toString())->toEqual($hr);
});

test('test hr with text align left', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->textAlignLeft()->render();
    $hr = "\e[0m───  Stay RAD!  ────" . PHP_EOL;
    expect(strings($value)->toString())->toEqual($hr);
});

test('test hr with text align right', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->textAlignRight()->render();
    $hr =  "\e[0m────  Stay RAD!  ───" . PHP_EOL;
    expect(strings($value)->toString())->toEqual($hr);
});

test('test hr with text align center', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->textAlignCenter()->render();
    $hr = "\e[0m────  Stay RAD!  ───" . PHP_EOL;
    expect(strings($value)->toString())->toEqual($hr);
});

test('test hr with double border', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->bDouble()->render();
    $hr = "\e[0m═══  Stay RAD!  ════" . PHP_EOL;
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