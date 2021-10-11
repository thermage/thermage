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
