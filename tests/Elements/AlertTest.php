<?php

declare(strict_types=1);

use Thermage\Thermage;
use Thermage\Themes\Theme;
use Thermage\Themes\ThemeInterface;
use Thermage\Elements\Alert;
use Glowy\Arrays\Arrays as Collection;
use function arrays as collection;
use function Thermage\alert;
use function Thermage\setTheme;
use function Thermage\getTheme;
use function Thermage\getCsi;

beforeEach(function() {
    setTheme(new AlertTestTheme());
});

test('test alert w auto', function (): void {
    $value = alert('Stay RAD!')->wAuto()->render();
    $alert = getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30mStayRAD!" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert info', function (): void {
    $value = alert('Stay RAD!')->info()->render();
    $alert = getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30mStayRAD!" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert warning', function (): void {
    $value = alert('Stay RAD!')->warning()->render();
    $alert = getCsi() . "30m" . getCsi() . "43m" . getCsi() . "0m" . getCsi() . "43m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "43m" . getCsi() . "0m" . getCsi() . "43m" . getCsi() . "30mStayRAD!" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "43m" . getCsi() . "0m" . getCsi() . "43m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert danger', function (): void {
    $value = alert('Stay RAD!')->danger()->render();
    $alert = getCsi() . "37m" . getCsi() . "41m" . getCsi() . "0m" . getCsi() . "41m" . getCsi() . "37m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "37m" . getCsi() . "41m" . getCsi() . "0m" . getCsi() . "41m" . getCsi() . "37mStayRAD!" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "37m" . getCsi() . "41m" . getCsi() . "0m" . getCsi() . "41m" . getCsi() . "37m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert success', function (): void {
    $value = alert('Stay RAD!')->success()->render();
    $alert = getCsi() . "30m" . getCsi() . "42m" . getCsi() . "0m" . getCsi() . "42m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "42m" . getCsi() . "0m" . getCsi() . "42m" . getCsi() . "30mStayRAD!" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "42m" . getCsi() . "0m" . getCsi() . "42m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert primary', function (): void {
    $value = alert('Stay RAD!')->primary()->render();
    $alert = getCsi() . "37m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "37m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "37m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "37mStayRAD!" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "37m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "37m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert secondary', function (): void {
    $value = alert('Stay RAD!')->secondary()->render();
    $alert = getCsi() . "30m" . getCsi() . "100m" . getCsi() . "0m" . getCsi() . "100m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "100m" . getCsi() . "0m" . getCsi() . "100m" . getCsi() . "30mStayRAD!" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "100m" . getCsi() . "0m" . getCsi() . "100m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert with text align right', function (): void {
    $value = alert('Stay RAD!')->textAlignRight()->render();
    $alert = getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30mStayRAD!" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert with text align left', function (): void {
    $value = alert('Stay RAD!')->textAlignLeft()->render();
    $alert = getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30mStayRAD!" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert w', function (): void {
    $value = alert('Stay RAD!')->w(200)->render();
    $alert = getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30mStayRAD!" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m";
    expect(str_replace([PHP_EOL, " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert w magic', function (): void {
    $value = alert('Stay RAD!')->w200()->render();
    $alert = getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30mStayRAD!" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m" . getCsi() . "30m" . getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44m" . getCsi() . "30m" . getCsi() . "39m" . getCsi() . "49m" . getCsi() . "49m" . getCsi() . "39m";
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