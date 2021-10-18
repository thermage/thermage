<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Themes\Theme;
use Termage\Elements\Alert;
use function Termage\alert;

test('test termage alert method', function (): void {
    $this->assertInstanceOf(Alert::class, alert());
});

test('test alert info', function (): void {
    $value = alert('Stay RAD!')->info()->render();
    $alert = "\e[48;2;23;162;184m\e[49m\e[38;2;0;0;0m\e[48;2;23;162;184mStayRAD!\e[49m\e[39m\e[48;2;23;162;184m\e[49m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert warning', function (): void {
    $value = alert('Stay RAD!')->warning()->render();
    $alert = "\e[48;2;255;193;7m\e[49m\e[38;2;0;0;0m\e[48;2;255;193;7mStayRAD!\e[49m\e[39m\e[48;2;255;193;7m\e[49m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert danger', function (): void {
    $value = alert('Stay RAD!')->danger()->render();
    $alert = "\e[48;2;220;53;69m\e[49m\e[38;2;255;255;255m\e[48;2;220;53;69mStayRAD!\e[49m\e[39m\e[48;2;220;53;69m\e[49m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert success', function (): void {
    $value = alert('Stay RAD!')->success()->render();
    $alert = "\e[48;2;40;167;69m\e[49m\e[38;2;0;0;0m\e[48;2;40;167;69mStayRAD!\e[49m\e[39m\e[48;2;40;167;69m\e[49m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert primary', function (): void {
    $value = alert('Stay RAD!')->primary()->render();
    $alert = "\e[48;2;0;123;255m\e[49m\e[38;2;255;255;255m\e[48;2;0;123;255mStayRAD!\e[49m\e[39m\e[48;2;0;123;255m\e[49m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert secondary', function (): void {
    $value = alert('Stay RAD!')->secondary()->render();
    $alert = "\e[48;2;108;117;125m\e[49m\e[38;2;108;117;125m\e[48;2;108;117;125mStayRAD!\e[49m\e[39m\e[48;2;108;117;125m\e[49m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert with text align right', function (): void {
    $value = alert('Stay RAD!')->textAlignRight()->render();
    $alert = "\e[48;2;23;162;184m\e[49m\e[38;2;0;0;0m\e[48;2;23;162;184mStayRAD!\e[49m\e[39m\e[48;2;23;162;184m\e[49m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert with text align left', function (): void {
    $value = alert('Stay RAD!')->textAlignLeft()->render();
    $alert = "\e[48;2;23;162;184m\e[49m\e[38;2;0;0;0m\e[48;2;23;162;184mStayRAD!\e[49m\e[39m\e[48;2;23;162;184m\e[49m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert size', function (): void {
    $value = alert('Stay RAD!')->size(200)->render();
    $alert = "\e[48;2;23;162;184m\e[49m\e[38;2;0;0;0m\e[48;2;23;162;184mStayRAD!\e[49m\e[39m\e[48;2;23;162;184m\e[49m";
    expect(str_replace(["\r\n", "\r", "\n", " "], "", strings($value)->trim()->toString()))->toEqual($alert);
});