<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Themes\Theme;
use Termage\Themes\ThemeInterface;
use Termage\Elements\Alert;
use Atomastic\Arrays\Arrays as Collection;
use function arrays as collection;
use function Termage\alert;
use function Termage\render;
use function Termage\setTheme;
use function Termage\getTheme;

beforeEach(function() {
    setTheme(new AlertTestTheme());
});

test('test alert w auto', function (): void {
    $value = render(alert('Stay RAD!')->wAuto());
    $alert = "\e[30m\e[44m\e[49m\e[39m\e[30m\e[44mStayRAD!\e[49m\e[39m\e[30m\e[44m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert info', function (): void {
    $value = render(alert('Stay RAD!')->info());
    $alert = "\e[30m\e[44m\e[49m\e[39m\e[30m\e[44mStayRAD!\e[49m\e[39m\e[30m\e[44m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert warning', function (): void {
    $value = render(alert('Stay RAD!')->warning());
    $alert = "\e[30m\e[43m\e[49m\e[39m\e[30m\e[43mStayRAD!\e[49m\e[39m\e[30m\e[43m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert danger', function (): void {
    $value = render(alert('Stay RAD!')->danger());
    $alert = "\e[37m\e[41m\e[49m\e[39m\e[37m\e[41mStayRAD!\e[49m\e[39m\e[37m\e[41m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert success', function (): void {
    $value = render(alert('Stay RAD!')->success());
    $alert = "\e[30m\e[42m\e[49m\e[39m\e[30m\e[42mStayRAD!\e[49m\e[39m\e[30m\e[42m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert primary', function (): void {
    $value = render(alert('Stay RAD!')->primary());
    $alert = "\e[37m\e[44m\e[49m\e[39m\e[37m\e[44mStayRAD!\e[49m\e[39m\e[37m\e[44m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert secondary', function (): void {
    $value = render(alert('Stay RAD!')->secondary());
    $alert = "\e[30m\e[100m\e[49m\e[39m\e[30m\e[100mStayRAD!\e[49m\e[39m\e[30m\e[100m\e[49m\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert with text align right', function (): void {
    $value = render(alert('Stay RAD!')->textAlignRight());
    $alert = "\e[30m\e[44m\e[49m\e[39m\e[30m\e[44mStayRAD!\e[49m\e[39m\e[30m\e[44m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert with text align left', function (): void {
    $value = render(alert('Stay RAD!')->textAlignLeft());
    $alert = "\e[30m\e[44m\e[49m\e[39m\e[30m\e[44mStayRAD!\e[49m\e[39m\e[30m\e[44m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert w', function (): void {
    $value = render(alert('Stay RAD!')->w(200));
    $alert = "\e[30m\e[44m\e[49m\e[39m\e[30m\e[44mStayRAD!\e[49m\e[39m\e[30m\e[44m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert w magic', function (): void {
    $value = render(alert('Stay RAD!')->w200());
    $alert = "\e[30m\e[44m\e[49m\e[39m\e[30m\e[44mStayRAD!\e[49m\e[39m\e[30m\e[44m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

class AlertTestTheme extends Theme implements ThemeInterface
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
            'alert' => [
                'text-align' => 'left',
                'size-auto' => false,
                'size' => 50,
                'type' => [
                    'info' => [
                        'bg' => 'blue',
                        'color' => 'black',
                    ],
                    'warning' => [
                        'bg' => 'yellow',
                        'color' => 'black',
                    ],
                    'danger' => [
                        'bg' => 'red',
                        'color' => 'white',
                    ],
                    'success' => [
                        'bg' => 'green',
                        'color' => 'black',
                    ],
                    'primary' => [
                        'bg' => 'blue',
                        'color' => 'white',
                    ],
                    'secondary' => [
                        'bg' => 'gray',
                        'color' => 'black',
                    ],
                ],
            ],
        ]);
    }
}