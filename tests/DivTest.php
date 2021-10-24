<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Themes\Theme;
use Termage\Themes\ThemeInterface;
use Termage\Elements\Div;
use function Termage\div;
use function Termage\setTheme;
use Termage\Parsers\Shortcodes;

beforeEach(function() {
    setTheme(new DivTestTheme());
});

test('test set and get theme', function (): void {
    $this->assertInstanceOf(Theme::class, div()::getTheme());

    div()::setTheme(new DivTestTheme());
    $this->assertInstanceOf(DivTestTheme::class, div()::getTheme());
});

test('test color', function (): void {
    $value = div('RAD')->color('blue')->render();
    expect($value)->toBe("\e[34mRAD\e[39m\n");
});

test('test magic color', function (): void {
    $value = div()->value('RAD')->colorBlue()->render();
    expect($value)->toBe("\e[34mRAD\e[39m\n");
});

test('test bg', function (): void {
    $value = div()->value('RAD')->bg('blue')->render();
    expect($value)->toBe("\e[44mRAD\e[49m\n");
});

test('test magic bg', function (): void {
    $value = div()->value('RAD')->bgBlue()->render();
    expect($value)->toBe("\e[44mRAD\e[49m\n");
});

test('test bold', function (): void {
    $value = div()->value('RAD')->bold()->render();
    expect($value)->toBe("\e[1mRAD\e[22m\n");
});

test('test underline', function (): void {
    $value = div()->value('RAD')->underline()->render();
    expect($value)->toBe("\e[4mRAD\e[24m\n");
});

test('test blink', function (): void {
    $value = div()->value('RAD')->blink()->render();
    expect($value)->toBe("\e[5mRAD\e[25m\n");
});

test('test italic', function (): void {
    $value = div()->value('RAD')->italic()->render();
    expect($value)->toBe("\e[3mRAD\e[23m\n");
});

test('test strikethrough', function (): void {
    $value = div()->value('RAD')->strikethrough()->render();
    expect($value)->toBe("\e[9mRAD\e[29m\n");
});

test('test reverse', function (): void {
    $value = div()->value('RAD')->reverse()->render();
    expect($value)->toBe("\e[7mRAD\e[27m\n");
});

test('test invisible', function (): void {
    $value = div()->value('RAD')->invisible()->render();
    expect($value)->toBe("\e[8mRAD\e[28m\n");
});

test('test value and getValue', function (): void {
    $value = div()->value('RAD');
    expect($value->render())->toBe('RAD' . PHP_EOL);
    expect($value->getValue())->toBe('RAD');
});

test('test classes and getClasses', function (): void {
    $value = div()->classes('RAD');;
    expect($value->getClasses())->toBe('RAD');
});

test('test mx', function (): void {
    $value = div()->value('RAD')->mx(10)->render();
    expect($value)->toBe('     RAD     ' . PHP_EOL);
});

test('test magic mx', function (): void {
    $value = div()->value('RAD')->mx10()->render();
    expect($value)->toBe('     RAD     ' . PHP_EOL);
});

test('test mr', function (): void {
    $value = div()->value('RAD')->mr(10)->render();
    expect($value)->toBe('RAD          ' . PHP_EOL);
});

test('test magic mr', function (): void {
    $value = div()->value('RAD')->mr10()->render();
    expect($value)->toBe('RAD          ' . PHP_EOL);
});

test('test ml', function (): void {
    $value = div()->value('RAD')->ml(10)->render();
    expect($value)->toBe('          RAD' . PHP_EOL);
});

test('test magic ml', function (): void {
    $value = div()->value('RAD')->ml10()->render();
    expect($value)->toBe('          RAD' . PHP_EOL);
});

test('test px', function (): void {
    $value = div()->value('RAD')->px(10)->render();
    expect($value)->toBe('     RAD     ' . PHP_EOL);
});

test('test magic px', function (): void {
    $value = div()->value('RAD')->px10()->render();
    expect($value)->toBe('     RAD     ' . PHP_EOL);
});

test('test pr', function (): void {
    $value = div()->value('RAD')->pr(10)->render();
    expect($value)->toBe('RAD          ' . PHP_EOL);
});

test('test magic pr', function (): void {
    $value = div()->value('RAD')->pr10()->render();
    expect($value)->toBe('RAD          ' . PHP_EOL);
});

test('test pl', function (): void {
    $value = div()->value('RAD')->pl(10)->render();
    expect($value)->toBe('          RAD' . PHP_EOL);
});

test('test magic pl', function (): void {
    $value = div()->value('RAD')->pl10()->render();
    expect($value)->toBe('          RAD' . PHP_EOL);
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
    expect((string) $value)->toBe('RAD' . PHP_EOL);
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