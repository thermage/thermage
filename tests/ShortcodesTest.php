<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Parsers\Shortcodes;
use Thunder\Shortcode\ShortcodeFacade;
use Termage\Themes\Theme;
use Termage\Themes\ThemeInterface;

test('test termage getShortcodes method', function (): void {
    $this->assertInstanceOf(Shortcodes::class, Termage::getShortcodes());
});

test('test set and get theme', function (): void {
    $this->assertInstanceOf(Theme::class, Termage::getShortcodes()::getTheme());

    Termage::getShortcodes()::setTheme(new ShortcodeTestTheme());
    $this->assertInstanceOf(ShortcodeTestTheme::class, Termage::getShortcodes()::getTheme());
});

test('test getFacade method', function (): void {
    $this->assertInstanceOf(ShortcodeFacade::class, Termage::getShortcodes()->getFacade());
});

test('test add and parse and parseText method', function (): void {
    
    Termage::getShortcodes()->add('foo', function($s){ 
        return 'Foo';
    });

    expect(Termage::getShortcodes()->parseText('[foo]'))->toBeArray();
    expect(Termage::getShortcodes()->parse('[foo]'))->toEqual('Foo');
});

test('test stripShortcodes method', function (): void {
    expect(Termage::getShortcodes()->stripShortcodes('[foo]Foo[/foo]'))->toEqual('Foo');
    expect(Termage::getShortcodes()->stripShortcodes('[foo=bar]Foo[/foo]'))->toEqual('Foo');
    expect(Termage::getShortcodes()->stripShortcodes('[foo="bar"]Foo[/foo]'))->toEqual('Foo');
    expect(Termage::getShortcodes()->stripShortcodes('[foo x="1" y="2"]Foo[/foo]'))->toEqual('Foo');
    expect(Termage::getShortcodes()->stripShortcodes('[foo]Foo[/foo] Foo'))->toEqual('Foo Foo');
    expect(Termage::getShortcodes()->stripShortcodes('[foo]Foo[/foo] Foo [foo]Foo[/foo]'))->toEqual('Foo Foo Foo');
    expect(Termage::getShortcodes()->stripShortcodes('[foo/]Foo'))->toEqual('Foo');
    expect(Termage::getShortcodes()->stripShortcodes('[foo /]Foo'))->toEqual('Foo');
    expect(Termage::getShortcodes()->stripShortcodes('[foo="Foo" /]Foo'))->toEqual('Foo');
    expect(Termage::getShortcodes()->stripShortcodes('[foo ]Foo'))->toEqual('Foo');
    expect(Termage::getShortcodes()->stripShortcodes('[foo]Foo'))->toEqual('Foo');
    expect(Termage::getShortcodes()->stripShortcodes('[foo x="1" y="2"]Foo'))->toEqual('Foo');
    expect(Termage::getShortcodes()->stripShortcodes('[foo]F[o]o[/foo]'))->toEqual('Fo');

    // @todo: find a way to process these cases:
    // expect(Termage::getShortcodes()->stripShortcodes('[foo]F[oo[/foo]'))->toEqual('F[oo');
});

test('test [bold] and [b] shortcodes', function (): void {
    
    expect(Termage::getShortcodes()->parse('[bold]bold[/bold]'))->toEqual("\e[1mbold\e[22m");
    expect(Termage::getShortcodes()->parse('[b]bold[/b]'))->toEqual("\e[1mbold\e[22m");
});

test('test [italic] and [i] shortcodes', function (): void {
    
    expect(Termage::getShortcodes()->parse('[italic]italic[/italic]'))->toEqual("\e[3mitalic\e[23m");
    expect(Termage::getShortcodes()->parse('[i]italic[/i]'))->toEqual("\e[3mitalic\e[23m");
});

test('test [underline] and [u] shortcodes', function (): void {
    
    expect(Termage::getShortcodes()->parse('[underline]underline[/underline]'))->toEqual("\e[4munderline\e[24m");
    expect(Termage::getShortcodes()->parse('[u]underline[/u]'))->toEqual("\e[4munderline\e[24m");
});

test('test [strikethrough] and [s] shortcodes', function (): void {
    
    expect(Termage::getShortcodes()->parse('[strikethrough]strikethrough[/strikethrough]'))->toEqual("\e[9mstrikethrough\e[29m");
    expect(Termage::getShortcodes()->parse('[s]strikethrough[/s]'))->toEqual("\e[9mstrikethrough\e[29m");
});

test('test [dim] and [d] shortcodes', function (): void {
    
    expect(Termage::getShortcodes()->parse('[dim]dim[/dim]'))->toEqual("\e[2mdim\e[22m");
    expect(Termage::getShortcodes()->parse('[d]dim[/d]'))->toEqual("\e[2mdim\e[22m");
});

test('test [blink] shortcodes', function (): void {
    
    expect(Termage::getShortcodes()->parse('[blink]blink[/blink]'))->toEqual("\e[5mblink\e[25m");
});

test('test [reverse] shortcodes', function (): void {
    
    expect(Termage::getShortcodes()->parse('[reverse]reverse[/reverse]'))->toEqual("\e[7mreverse\e[27m");
});

test('test [invisible] shortcodes', function (): void {
    
    expect(Termage::getShortcodes()->parse('[invisible]invisible[/invisible]'))->toEqual("\e[8minvisible\e[28m");
});

test('test [anchor] shortcodes', function (): void {
    
    expect(Termage::getShortcodes()->parse('[anchor href="https://github.com/termage/termage"]Termage[/anchor]'))->toEqual("\e]8;;https://github.com/termage/termage\e\\Termage\e]8;;\e\\");
});

test('test [m l= r=] shortcodes', function (): void {
    
    expect(Termage::getShortcodes()->parse('[m l=2 r=2]Margin left and right[/m]'))->toEqual("  Margin left and right  ");
});

test('test [mx=] shortcodes', function (): void {
    
    expect(Termage::getShortcodes()->parse('[mx=4]Margin left and right[/mx]'))->toEqual("  Margin left and right  ");
});

test('test [ml=] shortcodes', function (): void {
    
    expect(Termage::getShortcodes()->parse('[ml=2]Margin left[/ml]'))->toEqual("  Margin left");
});

test('test [mr=] shortcodes', function (): void {
    
    expect(Termage::getShortcodes()->parse('[mr=2]Margin right[/mr]'))->toEqual("Margin right  ");
});

test('test [p l= r=] shortcodes', function (): void {
    
    expect(Termage::getShortcodes()->parse('[p l=2 r=2]Padding left and right[/p]'))->toEqual("  Padding left and right  ");
});

test('test [px=] shortcodes', function (): void {
    expect(Termage::getShortcodes()->parse('[px=4]Padding left and right[/px]'))->toEqual("  Padding left and right  ");
});

test('test [pl=] shortcodes', function (): void {
    
    expect(Termage::getShortcodes()->parse('[pl=2]Padding left[/pl]'))->toEqual("  Padding left");
});

test('test [pr=] shortcodes', function (): void {
    expect(Termage::getShortcodes()->parse('[pr=2]Padding right[/pr]'))->toEqual("Padding right  ");
});

class ShortcodeTestTheme extends Theme implements ThemeInterface
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
        ];
    }
}