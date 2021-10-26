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
    $hr = "\e[34m―――\e[39m\e[34mStayRAD!\e[39m\e[34m――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test hr without value', function (): void {
    putenv('COLUMNS=20');
    $value = hr()->render();
    $hr = "\e[34m――――――――――――――――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test hr with text align left', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->textAlignLeft()->render();
    $hr = "\e[34m―――\e[39m\e[34mStayRAD!\e[39m\e[34m――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test hr with text align right', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->textAlignRight()->render();
    $hr = "\e[34m――――――\e[39m\e[34mStayRAD!\e[39m\e[34m―――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test hr info', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->info()->render();
    $hr = "\e[34m―――\e[39m\e[34mStayRAD!\e[39m\e[34m――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test hr danger', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->danger()->render();
    $hr = "\e[31m―――\e[39m\e[31mStayRAD!\e[39m\e[31m――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test hr warning', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->warning()->render();
    $hr = "\e[33m―――\e[39m\e[33mStayRAD!\e[39m\e[33m――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test hr success', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->success()->render();
    $hr = "\e[32m―――\e[39m\e[32mStayRAD!\e[39m\e[32m――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test hr primary', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->primary()->render();
    $hr = "\e[34m―――\e[39m\e[34mStayRAD!\e[39m\e[34m――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test hr secondary', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->secondary()->render();
    $hr = "\e[90m―――\e[39m\e[90mStayRAD!\e[39m\e[90m――――――\e[39m";
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