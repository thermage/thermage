<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Themes\Theme;
use Termage\Themes\ThemeInterface;
use function Termage\setTheme;
use function Termage\hr;

beforeEach(function() {
    setTheme(new HrTestTheme());
});

test('test hr', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->render();
    dd(str_replace(["\r\n", "\r", "\n", " "], "", $value));
    $hr = "\e[38;2;23;162;184m―――\e[39m\e[38;2;23;162;184mStayRAD!\e[39m\e[38;2;23;162;184m――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test hr with text align left', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->textAlignLeft()->render();
    $hr = "\e[38;2;23;162;184m―――\e[39m\e[38;2;23;162;184mStayRAD!\e[39m\e[38;2;23;162;184m――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test hr with text align right', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->textAlignRight()->render();
    $hr = "\e[38;2;23;162;184m――――――\e[39m\e[38;2;23;162;184mStayRAD!\e[39m\e[38;2;23;162;184m―――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test hr info', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->info()->render();
    $hr = "\e[38;2;23;162;184m―――\e[39m\e[38;2;23;162;184mStayRAD!\e[39m\e[38;2;23;162;184m――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test danger info', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->danger()->render();
    $hr = "\e[38;2;220;53;69m―――\e[39m\e[38;2;220;53;69mStayRAD!\e[39m\e[38;2;220;53;69m――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test warning info', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->warning()->render();
    $hr = "\e[38;2;255;193;7m―――\e[39m\e[38;2;255;193;7mStayRAD!\e[39m\e[38;2;255;193;7m――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test success info', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->success()->render();
    $hr = "\e[38;2;40;167;69m―――\e[39m\e[38;2;40;167;69mStayRAD!\e[39m\e[38;2;40;167;69m――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test primary info', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->success()->render();
    $hr = "\e[38;2;40;167;69m―――\e[39m\e[38;2;40;167;69mStayRAD!\e[39m\e[38;2;40;167;69m――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});

test('test secondary info', function (): void {
    putenv('COLUMNS=20');
    $value = hr('Stay RAD!')->secondary()->render();
    $hr = "\e[38;2;108;117;125m―――\e[39m\e[38;2;108;117;125mStayRAD!\e[39m\e[38;2;108;117;125m――――――\e[39m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($hr);
});


class HrTestTheme extends Theme implements ThemeInterface
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
            'hr' => [
                'text-align' => 'left',
                'type' => [
                    'info' => ['color' => 'info'],
                    'warning' => ['color' => 'warning'],
                    'danger' => ['color' => 'danger'],
                    'success' => ['color' => 'success'],
                    'primary' => ['color' => 'primary'],
                    'secondary' => ['color' => 'secondary'],
                ],
            ],
        ];
    }
}