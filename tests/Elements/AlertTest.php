<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Themes\Theme;
use Termage\Themes\ThemeInterface;
use Termage\Elements\Alert;
use Atomastic\Arrays\Arrays as Collection;
use function arrays as collection;
use function Termage\alert;
use function Termage\setTheme;
use function Termage\getTheme;

beforeEach(function() {
    setTheme(new AlertTestTheme());
});

test('test alert w auto', function (): void {
    $value = alert('Stay RAD!')->wAuto()->render();
    $alert = "\e[30m\e[44m\e[49m\e[39m\e[30m\e[44mStayRAD!\e[49m\e[39m\e[30m\e[44m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert info', function (): void {
    $value = alert('Stay RAD!')->info()->render();
    $alert = "\e[30m\e[44m\e[49m\e[39m\e[30m\e[44mStayRAD!\e[49m\e[39m\e[30m\e[44m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert warning', function (): void {
    $value = alert('Stay RAD!')->warning()->render();
    $alert = "\e[30m\e[43m\e[49m\e[39m\e[30m\e[43mStayRAD!\e[49m\e[39m\e[30m\e[43m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert danger', function (): void {
    $value = alert('Stay RAD!')->danger()->render();
    $alert = "\e[37m\e[41m\e[49m\e[39m\e[37m\e[41mStayRAD!\e[49m\e[39m\e[37m\e[41m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert success', function (): void {
    $value = alert('Stay RAD!')->success()->render();
    $alert = "\e[30m\e[42m\e[49m\e[39m\e[30m\e[42mStayRAD!\e[49m\e[39m\e[30m\e[42m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert primary', function (): void {
    $value = alert('Stay RAD!')->primary()->render();
    $alert = "\e[37m\e[44m\e[49m\e[39m\e[37m\e[44mStayRAD!\e[49m\e[39m\e[37m\e[44m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert secondary', function (): void {
    $value = alert('Stay RAD!')->secondary()->render();
    $alert = "\e[30m\e[100m\e[49m\e[39m\e[30m\e[100mStayRAD!\e[49m\e[39m\e[30m\e[100m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert with text align right', function (): void {
    $value = alert('Stay RAD!')->textAlignRight()->render();
    $alert = "\e[30m\e[44m\e[49m\e[39m\e[30m\e[44mStayRAD!\e[49m\e[39m\e[30m\e[44m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert with text align left', function (): void {
    $value = alert('Stay RAD!')->textAlignLeft()->render();
    $alert = "\e[30m\e[44m\e[49m\e[39m\e[30m\e[44mStayRAD!\e[49m\e[39m\e[30m\e[44m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert w', function (): void {
    $value = alert('Stay RAD!')->w(200)->render();
    $alert = "\e[30m\e[44m\e[49m\e[39m\e[30m\e[44mStayRAD!\e[49m\e[39m\e[30m\e[44m\e[49m\e[39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert w magic', function (): void {
    $value = alert('Stay RAD!')->w200()->render();
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