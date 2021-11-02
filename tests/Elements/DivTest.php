<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Themes\Theme;
use Termage\Themes\ThemeInterface;
use Termage\Elements\Div;
use Atomastic\Arrays\Arrays as Collection;
use function arrays as collection;
use function Termage\render;
use function Termage\div;
use function Termage\setTheme;
use Termage\Parsers\Shortcodes;

beforeEach(function() {
    setTheme(new DivTestTheme());
    putenv('COLUMNS=20');
});

test('test set and get theme', function (): void {
    $this->assertInstanceOf(Theme::class, div()::getTheme());

    div()::setTheme(new DivTestTheme());
    $this->assertInstanceOf(DivTestTheme::class, div()::getTheme());
});

test('test color', function (): void {
    $value = render(div('RAD')->color('blue'));
    expect($value)->toBe("\e[34mRAD                 \e[39m\n");
});

test('test magic color', function (): void {
    $value = render(div()->value('RAD')->colorBlue());     
    expect($value)->toBe("\e[34mRAD                 \e[39m\n");
});

test('test bg', function (): void {
    $value = render(div()->value('RAD')->bg('blue'));
    expect($value)->toBe("\e[44mRAD                 \e[49m\n");
});

test('test magic bg', function (): void {
    $value = render(div()->value('RAD')->bgBlue());
    expect($value)->toBe("\e[44mRAD                 \e[49m" . PHP_EOL);
});

test('test bold', function (): void {
    $value = render(div()->value('RAD')->bold());
    expect($value)->toBe("\e[1mRAD\e[22m                 " . PHP_EOL);
});

test('test underline', function (): void {
    $value = render(div()->value('RAD')->underline());
    expect($value)->toBe("\e[4mRAD\e[24m                 " . PHP_EOL);
});

test('test blink', function (): void {
    $value = render(div()->value('RAD')->blink());
    expect($value)->toBe("\e[5mRAD\e[25m                 " . PHP_EOL);
});

test('test italic', function (): void {
    $value = render(div()->value('RAD')->italic());
    expect($value)->toBe("\e[3mRAD\e[23m                 " . PHP_EOL);
});

test('test dim', function (): void {
    $value = render(div()->value('RAD')->dim());
    expect($value)->toBe("\e[2mRAD\e[22m                 " . PHP_EOL);
});

test('test strikethrough', function (): void {
    $value = render(div()->value('RAD')->strikethrough());
    expect($value)->toBe("\e[9mRAD\e[29m                 " . PHP_EOL);
});

test('test reverse', function (): void {
    $value = render(div()->value('RAD')->reverse());
    expect($value)->toBe("\e[7mRAD\e[27m                 " . PHP_EOL);
});

test('test invisible', function (): void {
    $value = render(div()->value('RAD')->invisible());
    expect($value)->toBe("\e[8mRAD\e[28m                 " . PHP_EOL);
});

test('test value and getValue', function (): void {
    $div = div()->value('RAD');
    expect(render($div))->toBe("RAD                 " . PHP_EOL);
    expect(render($div->getValue()))->toBe("RAD                 " . PHP_EOL);
});

test('test classes and getClasses', function (): void {
    $value = div()->classes('RAD');;
    expect($value->getClasses())->toBe('RAD');
});

test('test mx', function (): void {
    $value = render(div()->value('RAD')->mx(10));
    expect($value)->toBe("          RAD                           " . PHP_EOL);
});

test('test magic mx', function (): void {
    $value = render(div()->value('RAD')->mx10());
    expect($value)->toBe("          RAD                           " . PHP_EOL);
});

test('test mr', function (): void {
    $value = render(div()->value('RAD')->mr(10));
    expect($value)->toBe("RAD                           " . PHP_EOL);
});

test('test magic mr', function (): void {
    $value = render(div()->value('RAD')->mr10());
    expect($value)->toBe("RAD                           " . PHP_EOL);
});

test('test ml', function (): void {
    $value = render(div()->value('RAD')->ml(10));
    expect($value)->toBe("          RAD                 " . PHP_EOL);
});

test('test magic ml', function (): void {
    $value = render(div()->value('RAD')->ml10());
    expect($value)->toBe("          RAD                 " . PHP_EOL);
});

test('test px', function (): void {
    $value = render(div()->value('RAD')->px(10));
    expect($value)->toBe("          RAD       " . PHP_EOL);
});

test('test magic px', function (): void {
    $value = render(div()->value('RAD')->px10());
    expect($value)->toBe("          RAD       " . PHP_EOL);
});

test('test pr', function (): void {
    $value = render(div()->value('RAD')->pr(10));
    expect($value)->toBe("RAD                 " . PHP_EOL);
});

test('test magic pr', function (): void {
    $value = render(div()->value('RAD')->pr10());
    expect($value)->toBe("RAD                 " . PHP_EOL);
});

test('test pl', function (): void {
    $value = render(div()->value('RAD')->pl(10));
    expect($value)->toBe('          RAD       ' . PHP_EOL);
});

test('test magic pl', function (): void {
    $value = render(div()->value('RAD')->pl10());
    expect($value)->toBe('          RAD       ' . PHP_EOL);
});

test('test getTheme', function (): void {
    $value = div()->getTheme();
    $this->assertInstanceOf(Theme::class, $value);
});

test('magic throw exception BadMethodCallException', function (): void {
    div()->foo();
})->throws(BadMethodCallException::class);

test('test magic __toString', function (): void {
    $value = div()->value('RAD');
    expect((string) $value)->toBe(PHP_EOL . 'RAD                 ');
});

test('test getShortcodes', function (): void {
    $this->assertInstanceOf(Shortcodes::class, div()::getShortcodes());
});

test('test setShortcodes', function (): void {
    div()::setShortcodes(div()::getShortcodes());
    $this->assertInstanceOf(Shortcodes::class, div()::getShortcodes());
});

class DivTestTheme extends Theme implements ThemeInterface
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