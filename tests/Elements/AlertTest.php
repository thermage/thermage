<?php

declare(strict_types=1);

use Thermage\Thermage;
use Thermage\Themes\Theme;
use Thermage\Themes\ThemeInterface;
use Thermage\Elements\Alert;
use Thermage\Base\Element;
use Glowy\Arrays\Arrays as Collection;
use function arrays as collection;
use function Thermage\alert;
use function Thermage\setTheme;
use function Thermage\getTheme;
use function Thermage\terminal;

beforeEach(function() {
    setTheme(new AlertTestTheme());
});

test('test alert w auto', function (): void {
    $value = alert('Stay RAD!')->wAuto()->renderToString();
    $alert = terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30mStay RAD!" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m";
    expect(str_replace([PHP_EOL, Element::getSpace()], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert info', function (): void {
    $value = alert('Stay RAD!')->info()->renderToString();
    $alert = terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30mStay RAD!" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m";
    expect(str_replace([PHP_EOL, Element::getSpace()], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert warning', function (): void {
    $value = alert('Stay RAD!')->warning()->renderToString();
    $alert = terminal()->getCsi() . "30m" . terminal()->getCsi() . "43m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "43m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "43m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "43m" . terminal()->getCsi() . "30mStay RAD!" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "43m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "43m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m";
    expect(str_replace([PHP_EOL, Element::getSpace()], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert danger', function (): void {
    $value = alert('Stay RAD!')->danger()->renderToString();
    $alert = terminal()->getCsi() . "37m" . terminal()->getCsi() . "41m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "41m" . terminal()->getCsi() . "37m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "37m" . terminal()->getCsi() . "41m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "41m" . terminal()->getCsi() . "37mStay RAD!" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "37m" . terminal()->getCsi() . "41m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "41m" . terminal()->getCsi() . "37m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m";
    expect(str_replace([PHP_EOL, Element::getSpace()], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert success', function (): void {
    $value = alert('Stay RAD!')->success()->renderToString();
    $alert = terminal()->getCsi() . "30m" . terminal()->getCsi() . "42m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "42m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "42m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "42m" . terminal()->getCsi() . "30mStay RAD!" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "42m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "42m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m";
    expect(str_replace([PHP_EOL, Element::getSpace()], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert primary', function (): void {
    $value = alert('Stay RAD!')->primary()->renderToString();
    $alert = terminal()->getCsi() . "37m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "37m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "37m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "37mStay RAD!" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "37m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "37m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m";
    expect(str_replace([PHP_EOL, Element::getSpace()], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert secondary', function (): void {
    $value = alert('Stay RAD!')->secondary()->renderToString();
    $alert = terminal()->getCsi() . "30m" . terminal()->getCsi() . "100m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "100m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "100m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "100m" . terminal()->getCsi() . "30mStay RAD!" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "100m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "100m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m";
    expect(str_replace([PHP_EOL, Element::getSpace()], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert with text align right', function (): void {
    $value = alert('Stay RAD!')->textAlignRight()->renderToString();
    $alert = terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30mStay RAD!" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m";
    expect(str_replace([PHP_EOL, Element::getSpace()], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert with text align left', function (): void {
    $value = alert('Stay RAD!')->textAlignLeft()->renderToString();
    $alert = terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30mStay RAD!" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m";
    expect(str_replace([PHP_EOL, Element::getSpace()], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert w', function (): void {
    $value = alert('Stay RAD!')->w(200)->renderToString();
    $alert = terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30mStay RAD!" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m";
    expect(str_replace([PHP_EOL, Element::getSpace()], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert w magic', function (): void {
    $value = alert('Stay RAD!')->w200()->renderToString();
    $alert = terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30mStay RAD!" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44m" . terminal()->getCsi() . "30m" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "39m";
    expect(str_replace([PHP_EOL, Element::getSpace()], "", strings($value)->trim()->toString()))->toEqual($alert);
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