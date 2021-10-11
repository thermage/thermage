<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Base\Theme;
use Termage\Components\Alert;

test('test termage link method', function (): void {
    $this->assertInstanceOf(Alert::class, termage()->alert());
});

test('test alert info', function (): void {
    $value = termage()->alert('Stay RAD!')->info()->render();
    $alert = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][bg=info][p l=25 r=25][/p][/bg][/m][m l=0 r=0][bg=info][color=black][p l=2 r=39]Stay RAD![/p][/color][/bg][/m][m l=0 r=0][bg=info][p l=25 r=25][/p][/bg][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert warning', function (): void {
    $value = termage()->alert('Stay RAD!')->warning()->render();
    $alert = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][bg=warning][p l=25 r=25][/p][/bg][/m][m l=0 r=0][bg=warning][color=black][p l=2 r=39]Stay RAD![/p][/color][/bg][/m][m l=0 r=0][bg=warning][p l=25 r=25][/p][/bg][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert danger', function (): void {
    $value = termage()->alert('Stay RAD!')->danger()->render();
    $alert = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][bg=danger][p l=25 r=25][/p][/bg][/m][m l=0 r=0][bg=danger][color=white][p l=2 r=39]Stay RAD![/p][/color][/bg][/m][m l=0 r=0][bg=danger][p l=25 r=25][/p][/bg][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert success', function (): void {
    $value = termage()->alert('Stay RAD!')->success()->render();
    $alert = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][bg=success][p l=25 r=25][/p][/bg][/m][m l=0 r=0][bg=success][color=black][p l=2 r=39]Stay RAD![/p][/color][/bg][/m][m l=0 r=0][bg=success][p l=25 r=25][/p][/bg][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert primary', function (): void {
    $value = termage()->alert('Stay RAD!')->primary()->render();
    $alert = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][bg=primary][p l=25 r=25][/p][/bg][/m][m l=0 r=0][bg=primary][color=white][p l=2 r=39]Stay RAD![/p][/color][/bg][/m][m l=0 r=0][bg=primary][p l=25 r=25][/p][/bg][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert secondary', function (): void {
    $value = termage()->alert('Stay RAD!')->secondary()->render();
    $alert = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][bg=secondary][p l=25 r=25][/p][/bg][/m][m l=0 r=0][bg=secondary][color=white][p l=2 r=39]Stay RAD![/p][/color][/bg][/m][m l=0 r=0][bg=secondary][p l=25 r=25][/p][/bg][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test alert with text align right', function (): void {
    $value = termage()->alert('Stay RAD!')->textAlignRight()->render();
    $alert = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][bg=info][p l=25 r=25][/p][/bg][/m][m l=0 r=0][bg=info][color=black][p l=39 r=2]Stay RAD![/p][/color][/bg][/m][m l=0 r=0][bg=info][p l=25 r=25][/p][/bg][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($alert);
});
