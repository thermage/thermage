<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Base\Theme;
use Termage\Components\Rule;

test('test termage rule method', function (): void {
    $this->assertInstanceOf(Rule::class, termage()->rule());
});

test('test rule info', function (): void {
    $value = termage()->rule('Stay RAD!')->info()->render();
    $alert = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][color=info][p l=0 r=0]――― [/p][/color][/m][m l=0 r=0][color=info][p l=0 r=0]Stay RAD! [/p][/color][/m][m l=0 r=0][color=info][p l=0 r=0]―――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――[/p][/color][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test rule primary', function (): void {
    $value = termage()->rule('Stay RAD!')->primary()->render();
    $alert = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][color=primary][p l=0 r=0]――― [/p][/color][/m][m l=0 r=0][color=primary][p l=0 r=0]Stay RAD! [/p][/color][/m][m l=0 r=0][color=primary][p l=0 r=0]―――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――[/p][/color][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test rule secondary', function (): void {
    $value = termage()->rule('Stay RAD!')->secondary()->render();
    $alert = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][color=secondary][p l=0 r=0]――― [/p][/color][/m][m l=0 r=0][color=secondary][p l=0 r=0]Stay RAD! [/p][/color][/m][m l=0 r=0][color=secondary][p l=0 r=0]―――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――[/p][/color][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test rule success', function (): void {
    $value = termage()->rule('Stay RAD!')->success()->render();
    $alert = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][color=success][p l=0 r=0]――― [/p][/color][/m][m l=0 r=0][color=success][p l=0 r=0]Stay RAD! [/p][/color][/m][m l=0 r=0][color=success][p l=0 r=0]―――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――[/p][/color][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test rule warning', function (): void {
    $value = termage()->rule('Stay RAD!')->warning()->render();
    $alert = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][color=warning][p l=0 r=0]――― [/p][/color][/m][m l=0 r=0][color=warning][p l=0 r=0]Stay RAD! [/p][/color][/m][m l=0 r=0][color=warning][p l=0 r=0]―――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――[/p][/color][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test rule danger', function (): void {
    $value = termage()->rule('Stay RAD!')->danger()->render();
    $alert = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][color=danger][p l=0 r=0]――― [/p][/color][/m][m l=0 r=0][color=danger][p l=0 r=0]Stay RAD! [/p][/color][/m][m l=0 r=0][color=danger][p l=0 r=0]―――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――[/p][/color][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test rule with text align right', function (): void {
    $value = termage()->rule('Stay RAD!')->textAlignRight()->render();
    $alert = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][color=info][p l=0 r=0]―――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――[/p][/color][/m][m l=0 r=0][color=info][p l=0 r=0] Stay RAD![/p][/color][/m][m l=0 r=0][color=info][p l=0 r=0] ―――[/p][/color][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($alert);
});

test('test rule with text align left', function (): void {
    $value = termage()->rule('Stay RAD!')->textAlignLeft()->render();
    $alert = "[m l=0 r=0][p l=0 r=0][m l=0 r=0][color=info][p l=0 r=0]――― [/p][/color][/m][m l=0 r=0][color=info][p l=0 r=0]Stay RAD! [/p][/color][/m][m l=0 r=0][color=info][p l=0 r=0]―――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――――[/p][/color][/m][/p][/m]";
    expect(str_replace(["\r\n", "\r", "\n"], "", strings($value)->trim()->toString()))->toEqual($alert);
});