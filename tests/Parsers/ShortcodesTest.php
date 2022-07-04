<?php

declare(strict_types=1);

use Thermage\Thermage;
use Thermage\Parsers\Shortcodes;
use Thunder\Shortcode\ShortcodeFacade;
use Thunder\Shortcode\EventHandler\FilterRawEventHandler;
use Thunder\Shortcode\Events;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Thermage\Themes\Theme;
use Thermage\Themes\ThemeInterface;
use Glowy\Arrays\Arrays as Collection;
use function Glowy\Arrays\arrays as collection;

test('test thermage getShortcodes method', function (): void {
    $this->assertInstanceOf(Shortcodes::class, Thermage::getShortcodes());
});

test('test set and get theme', function (): void {
    $this->assertInstanceOf(Theme::class, Thermage::getShortcodes()::getTheme());

    Thermage::getShortcodes()::setTheme(new ShortcodeTestTheme());
    $this->assertInstanceOf(ShortcodeTestTheme::class, Thermage::getShortcodes()::getTheme());
});

test('test getFacade method', function (): void {
    $this->assertInstanceOf(ShortcodeFacade::class, Thermage::getShortcodes()->getFacade());
});

test('test add and parse and parseText method', function (): void {
    
    Thermage::getShortcodes()->add('foo', function($s){ 
        return 'Foo';
    });

    expect(Thermage::getShortcodes()->parseText('[foo]'))->toBeArray();
    expect(Thermage::getShortcodes()->parse('[foo]'))->toEqual('Foo');
});

test('test addEventHandler', function (): void {
    Thermage::getShortcodes()->add('raw2', static function (ShortcodeInterface $s) {
        return $s->getContent();
    });
    Thermage::getShortcodes()->addEvent(Events::FILTER_SHORTCODES, new FilterRawEventHandler(['raw2']));
    expect(Thermage::getShortcodes()->parse('[raw2][foo][/raw2]'))->toEqual('[foo]');
});

test('test stripShortcodes method', function (): void {
    expect(Thermage::getShortcodes()->stripShortcodes('[foo]Foo[/foo]'))->toEqual('Foo');
    expect(Thermage::getShortcodes()->stripShortcodes('[foo=bar]Foo[/foo]'))->toEqual('Foo');
    expect(Thermage::getShortcodes()->stripShortcodes('[foo="bar"]Foo[/foo]'))->toEqual('Foo');
    expect(Thermage::getShortcodes()->stripShortcodes('[foo x="1" y="2"]Foo[/foo]'))->toEqual('Foo');
    expect(Thermage::getShortcodes()->stripShortcodes('[foo]Foo[/foo] Foo'))->toEqual('Foo Foo');
    expect(Thermage::getShortcodes()->stripShortcodes('[foo]Foo[/foo] Foo [foo]Foo[/foo]'))->toEqual('Foo Foo Foo');
    expect(Thermage::getShortcodes()->stripShortcodes('[foo/]Foo'))->toEqual('Foo');
    expect(Thermage::getShortcodes()->stripShortcodes('[foo /]Foo'))->toEqual('Foo');
    expect(Thermage::getShortcodes()->stripShortcodes('[foo="Foo" /]Foo'))->toEqual('Foo');
    expect(Thermage::getShortcodes()->stripShortcodes('[foo ]Foo'))->toEqual('Foo');
    expect(Thermage::getShortcodes()->stripShortcodes('[foo]Foo'))->toEqual('Foo');
    expect(Thermage::getShortcodes()->stripShortcodes('[foo x="1" y="2"]Foo'))->toEqual('Foo');
    expect(Thermage::getShortcodes()->stripShortcodes('[foo]F[o]o[/foo]'))->toEqual('Fo');

    // @todo: find a way to process these cases:
    // expect(Thermage::getShortcodes()->stripShortcodes('[foo]F[oo[/foo]'))->toEqual('F[oo');
});

test('test [bold] and [b] shortcode', function (): void {
    expect(Thermage::getShortcodes()->parse('[bold]bold[/bold]'))->toEqual("\e[1mbold\e[22m");
    expect(Thermage::getShortcodes()->parse('[b]bold[/b]'))->toEqual("\e[1mbold\e[22m");
});

test('test [italic] and [i] shortcode', function (): void {
    expect(Thermage::getShortcodes()->parse('[italic]italic[/italic]'))->toEqual("\e[3mitalic\e[23m");
    expect(Thermage::getShortcodes()->parse('[i]italic[/i]'))->toEqual("\e[3mitalic\e[23m");
});

test('test [underline] and [u] shortcode', function (): void {
    expect(Thermage::getShortcodes()->parse('[underline]underline[/underline]'))->toEqual("\e[4munderline\e[24m");
    expect(Thermage::getShortcodes()->parse('[u]underline[/u]'))->toEqual("\e[4munderline\e[24m");
});

test('test [strikethrough] and [s] shortcode', function (): void {
    
    expect(Thermage::getShortcodes()->parse('[strikethrough]strikethrough[/strikethrough]'))->toEqual("\e[9mstrikethrough\e[29m");
    expect(Thermage::getShortcodes()->parse('[s]strikethrough[/s]'))->toEqual("\e[9mstrikethrough\e[29m");
});

test('test [dim] and [d] shortcode', function (): void {
    expect(Thermage::getShortcodes()->parse('[dim]dim[/dim]'))->toEqual("\e[2mdim\e[22m");
    expect(Thermage::getShortcodes()->parse('[d]dim[/d]'))->toEqual("\e[2mdim\e[22m");
});

test('test [blink] shortcode', function (): void {
    expect(Thermage::getShortcodes()->parse('[blink]blink[/blink]'))->toEqual("\e[5mblink\e[25m");
});

test('test [reverse] shortcode', function (): void {
    expect(Thermage::getShortcodes()->parse('[reverse]reverse[/reverse]'))->toEqual("\e[7mreverse\e[27m");
});

test('test [invisible] shortcode', function (): void {
    expect(Thermage::getShortcodes()->parse('[invisible]invisible[/invisible]'))->toEqual("\e[8minvisible\e[28m");
});

test('test [anchor] shortcode', function (): void {
    expect(Thermage::getShortcodes()->parse('[anchor href="https://github.com/thermage/thermage"]Thermage[/anchor]'))->toEqual("\e]8;;https://github.com/thermage/thermage\e\\Thermage\e]8;;\e\\");
});

test('test [bg=] shortcode', function (): void {
    expect(Thermage::getShortcodes()->parse('[bg=red]BG[/bg]'))->toEqual("\e[41mBG\e[49m");
    expect(Thermage::getShortcodes()->parse('[bg]BG[/bg]'))->toEqual("BG");
});

test('test [color=] shortcode', function (): void {
    expect(Thermage::getShortcodes()->parse('[color=red]COLOR[/color]'))->toEqual("\e[31mCOLOR\e[39m");
    expect(Thermage::getShortcodes()->parse('[color]COLOR[/color]'))->toEqual("COLOR");
});

class ShortcodeTestTheme extends Theme implements ThemeInterface
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
        ]);
    }
}