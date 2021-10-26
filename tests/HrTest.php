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
    $hr = "\e[37m───\e[39m\e[37mStayRAD!\e[39m\e[37m──────\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test hr without value', function (): void {
    putenv('COLUMNS=20');
    $value = hr()->render();
    $hr = "\e[37m────────────────────\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test hr with text align left', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->textAlignLeft()->render();
    $hr = "\e[37m───\e[39m\e[37mStayRAD!\e[39m\e[37m──────\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test hr with text align right', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->textAlignRight()->render();
    $hr = "\e[37m──────\e[39m\e[37mStayRAD!\e[39m\e[37m───\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
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
                'type' => [
                    'info' => ['color' => 'blue'],
                    'warning' => ['color' => 'yellow'],
                    'danger' => ['color' => 'red'],
                    'success' => ['color' => 'green'],
                    'primary' => ['color' => 'blue'],
                    'secondary' => ['color' => 'gray'],
                ],
            ],
        ]);
    }
}