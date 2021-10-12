<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Parsers\Shortcodes;
use Thunder\Shortcode\ShortcodeFacade;

test('test termage getShortcodes method', function (): void {
    $this->assertInstanceOf(Shortcodes::class, termage()->getShortcodes());
});

test('test getFacade method', function (): void {
    $this->assertInstanceOf(ShortcodeFacade::class, termage()->getShortcodes()->getFacade());
});

test('test addHandler and parse and parseText method', function (): void {
    $shortcodes = termage()->getShortcodes();

    $shortcodes->addHandler('foo', function($s){ 
        return 'Foo';
    });

    expect($shortcodes->parseText('[foo]'))->toBeArray();
    expect($shortcodes->parse('[foo]'))->toEqual('Foo');
});

test('test stripShortcodes method', function (): void {
    $shortcodes = termage()->getShortcodes();

    expect($shortcodes->stripShortcodes('[foo]Foo[/foo]'))->toEqual('Foo');
    expect($shortcodes->stripShortcodes('[foo=bar]Foo[/foo]'))->toEqual('Foo');
    expect($shortcodes->stripShortcodes('[foo="bar"]Foo[/foo]'))->toEqual('Foo');
    expect($shortcodes->stripShortcodes('[foo x="1" y="2"]Foo[/foo]'))->toEqual('Foo');
    expect($shortcodes->stripShortcodes('[foo]Foo[/foo] Foo'))->toEqual('Foo Foo');
    expect($shortcodes->stripShortcodes('[foo]Foo[/foo] Foo [foo]Foo[/foo]'))->toEqual('Foo Foo Foo');
    expect($shortcodes->stripShortcodes('[foo/]Foo'))->toEqual('Foo');
    expect($shortcodes->stripShortcodes('[foo /]Foo'))->toEqual('Foo');
    expect($shortcodes->stripShortcodes('[foo="Foo" /]Foo'))->toEqual('Foo');
    expect($shortcodes->stripShortcodes('[foo ]Foo'))->toEqual('Foo');
    expect($shortcodes->stripShortcodes('[foo]Foo'))->toEqual('Foo');
    expect($shortcodes->stripShortcodes('[foo x="1" y="2"]Foo'))->toEqual('Foo');
    expect($shortcodes->stripShortcodes('[foo]F[o]o[/foo]'))->toEqual('Fo');

    // @todo: find a way to process these cases:
    // expect($shortcodes->stripShortcodes('[foo]F[oo[/foo]'))->toEqual('F[oo');
});

test('test [bold] and [b] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[bold]bold[/bold]'))->toEqual("\e[1mbold\e[22m");
    expect($shortcodes->parse('[b]bold[/b]'))->toEqual("\e[1mbold\e[22m");
});

test('test [italic] and [i] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[italic]italic[/italic]'))->toEqual("\e[3mitalic\e[23m");
    expect($shortcodes->parse('[i]italic[/i]'))->toEqual("\e[3mitalic\e[23m");
});

test('test [underline] and [u] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[underline]underline[/underline]'))->toEqual("\e[4munderline\e[24m");
    expect($shortcodes->parse('[u]underline[/u]'))->toEqual("\e[4munderline\e[24m");
});

test('test [strikethrough] and [s] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[strikethrough]strikethrough[/strikethrough]'))->toEqual("\e[9mstrikethrough\e[29m");
    expect($shortcodes->parse('[s]strikethrough[/s]'))->toEqual("\e[9mstrikethrough\e[29m");
});

test('test [dim] and [d] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[dim]dim[/dim]'))->toEqual("\e[2mdim\e[22m");
    expect($shortcodes->parse('[d]dim[/d]'))->toEqual("\e[2mdim\e[22m");
});

test('test [blink] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[blink]blink[/blink]'))->toEqual("\e[5mblink\e[25m");
});

test('test [reverse] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[reverse]reverse[/reverse]'))->toEqual("\e[7mreverse\e[27m");
});

test('test [invisible] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[invisible]invisible[/invisible]'))->toEqual("\e[8minvisible\e[28m");
});

test('test [link] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[link href="https://github.com/termage/termage"]Termage[/link]'))->toEqual("\e]8;;https://github.com/termage/termage\e\\Termage\e]8;;\e\\");
});

test('test [m l= r=] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[m l=2 r=2]Margin left and right[/m]'))->toEqual("  Margin left and right  ");
});

test('test [mx=] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[mx=4]Margin left and right[/mx]'))->toEqual("  Margin left and right  ");
});

test('test [ml=] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[ml=2]Margin left[/ml]'))->toEqual("  Margin left");
});

test('test [mr=] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[mr=2]Margin right[/mr]'))->toEqual("Margin right  ");
});

test('test [p l= r=] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[p l=2 r=2]Padding left and right[/p]'))->toEqual("  Padding left and right  ");
});

test('test [px=] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[px=4]Padding left and right[/px]'))->toEqual("  Padding left and right  ");
});

test('test [pl=] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[pl=2]Padding left[/pl]'))->toEqual("  Padding left");
});

test('test [pr=] shortcodes', function (): void {
    $shortcodes = termage()->getShortcodes();
    expect($shortcodes->parse('[pr=2]Padding right[/pr]'))->toEqual("Padding right  ");
});