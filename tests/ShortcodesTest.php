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
