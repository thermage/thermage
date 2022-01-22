<?php

declare(strict_types=1);

use Thermage\Thermage;
use Thermage\Themes\Theme;
use Thermage\Themes\ThemeInterface;
use Thermage\Elements\Div;
use Glowy\Arrays\Arrays as Collection;
use function arrays as collection;
use function Thermage\div;
use function Thermage\span;
use function Thermage\setTheme;
use function Thermage\terminal;
use Thermage\Parsers\Shortcodes;
use Thermage\Base\Element;

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
    $value = div('RAD')->color('blue')->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "34m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "34mRAD§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "39m" . PHP_EOL);
});

test('test magic color', function (): void {
    $value = div()->value('RAD')->colorBlue()->renderToString(); 
    expect($value)->toBe(terminal()->getCsi() . "34m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "34mRAD§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "39m" . terminal()->getCsi() . "39m". PHP_EOL);
});

test('test bg', function (): void {
    $value = div()->value('RAD')->bg('blue')->renderToString();    
    expect($value)->toBe(terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44mRAD§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . PHP_EOL);
});

test('test magic bg', function (): void {
    $value = div()->value('RAD')->bgBlue()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "44m" . terminal()->getCsi() . "0m" . terminal()->getCsi() . "44mRAD§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "49m" . terminal()->getCsi() . "49m" . PHP_EOL);
});

test('test bold', function (): void {
    $value = div()->value('RAD')->bold()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m" . terminal()->getCsi() . "1mRAD" . terminal()->getCsi() . "22m§§§§§§§§§§§§§§§§§" . PHP_EOL);
});

test('test underline', function (): void {
    $value = div()->value('RAD')->underline()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m" . terminal()->getCsi() . "4mRAD" . terminal()->getCsi() . "24m§§§§§§§§§§§§§§§§§" . PHP_EOL);
});

test('test blink', function (): void {
    $value = div()->value('RAD')->blink()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m" . terminal()->getCsi() . "5mRAD" . terminal()->getCsi() . "25m§§§§§§§§§§§§§§§§§" . PHP_EOL);
});

test('test italic', function (): void {
    $value = div()->value('RAD')->italic()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m" . terminal()->getCsi() . "3mRAD" . terminal()->getCsi() . "23m§§§§§§§§§§§§§§§§§" . PHP_EOL);
});

test('test dim', function (): void {
    $value = div()->value('RAD')->dim()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m" . terminal()->getCsi() . "2mRAD" . terminal()->getCsi() . "22m§§§§§§§§§§§§§§§§§" . PHP_EOL);
});

test('test strikethrough', function (): void {
    $value = div()->value('RAD')->strikethrough()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m" . terminal()->getCsi() . "9mRAD" . terminal()->getCsi() . "29m§§§§§§§§§§§§§§§§§". PHP_EOL);
});

test('test reverse', function (): void {
    $value = div()->value('RAD')->reverse()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m" . terminal()->getCsi() . "7mRAD" . terminal()->getCsi() . "27m§§§§§§§§§§§§§§§§§" . PHP_EOL);
});

test('test invisible', function (): void {
    $value = div()->value('RAD')->invisible()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m" . terminal()->getCsi() . "8mRAD" . terminal()->getCsi() . "28m§§§§§§§§§§§§§§§§§" . PHP_EOL);
});

test('test value and getValue', function (): void {
    $div = div()->value('RAD');
    expect($div->renderToString())->toBe(terminal()->getCsi() . "0mRAD§§§§§§§§§§§§§§§§§" . PHP_EOL);
    expect($div->getValue())->toBe(terminal()->getCsi() . "0mRAD§§§§§§§§§§§§§§§§§" . PHP_EOL);
});

test('test classes and getClasses', function (): void {
    $value = div()->classes('RAD');
    expect($value->getClasses())->toBe('RAD');
});

test('test m', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->m(0, 10, 0, 10)->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m§§§§§§§§§§RAD§§§§§§§§§§§§§§§§§" . PHP_EOL);

    $value = div()->value('RAD')->m(2, 2, 2, 2)->renderToString();

    expect($value)->toBe(PHP_EOL . PHP_EOL . terminal()->getCsi() . "0m§§RAD§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . PHP_EOL . PHP_EOL . PHP_EOL);

    $value = div()->value('RAD')->m(2)->renderToString();
    expect($value)->toBe(PHP_EOL . PHP_EOL . terminal()->getCsi() . "0m§§RAD§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . PHP_EOL . PHP_EOL . PHP_EOL);

    $value = div()->value('RAD')->m2()->renderToString();
    expect($value)->toBe(PHP_EOL . PHP_EOL . terminal()->getCsi() . "0m§§RAD§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . PHP_EOL . PHP_EOL . PHP_EOL);
});

test('test my', function (): void {
    putenv('COLUMNS=40');
    
    $value = div()->value('RAD')->my(2)->renderToString();
    expect($value)->toBe(PHP_EOL . PHP_EOL . terminal()->getCsi() . "0mRAD§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . PHP_EOL . PHP_EOL . PHP_EOL);
});

test('test magic my', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->my2()->renderToString();

    expect($value)->toBe(PHP_EOL . PHP_EOL . terminal()->getCsi() . "0mRAD§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . PHP_EOL . PHP_EOL . PHP_EOL);
});

test('test mx', function (): void {
    putenv('COLUMNS=40');
    
    $value = div()->value('RAD')->mx(10)->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m§§§§§§§§§§RAD§§§§§§§§§§§§§§§§§" . PHP_EOL);
});

test('test magic mx', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->mx10()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m§§§§§§§§§§RAD§§§§§§§§§§§§§§§§§" . PHP_EOL);
});

test('test mr', function (): void {
    $value = div()->value('RAD')->mr(10)->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0mRAD§§§§§§§" . PHP_EOL);
});

test('test magic mr', function (): void {
    $value = div()->value('RAD')->mr10()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0mRAD§§§§§§§" . PHP_EOL);
});

test('test ml', function (): void {
    $value = div()->value('RAD')->ml(10)->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m§§§§§§§§§§RAD§§§§§§§" . PHP_EOL);
});

test('test clearfix', function (): void {
    $value = div(
        div('Stay').
        div('RAD')
    )->clearfix()->renderToString();

    expect($value)->toBe(terminal()->getCsi() . "0mStay§§§§§§§§§§§§§§§§" . PHP_EOL . terminal()->getCsi() . "0mRAD§§§§§§§§§§§§§§§§§" . PHP_EOL);

    $value = div(
        div(span('Stay').span('RAD')).
        div('!')
    )->clearfix()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0mStayRAD§§§§§§§§§§§§§" . PHP_EOL . terminal()->getCsi() . "0m!§§§§§§§§§§§§§§§§§§§" . PHP_EOL);
});

test('test magic ml', function (): void {
    $value = div()->value('RAD')->ml10()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m§§§§§§§§§§RAD§§§§§§§" . PHP_EOL);
});

test('test mt', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->mt2()->renderToString();
    $toBe =  PHP_EOL .
             PHP_EOL .
            terminal()->getCsi() . "0mRAD§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . PHP_EOL;
    expect($value)->toBe($toBe);
});

test('test magic mt', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->mt2()->renderToString();
    $toBe =  PHP_EOL .
             PHP_EOL .
            terminal()->getCsi() . "0mRAD§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . PHP_EOL;
    expect($value)->toBe($toBe);
});

test('test p', function (): void {
    $value = div()->value('RAD')->p(0, 10, 0, 10)->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m§§§§§§§§§§RAD§§§§§§§" . PHP_EOL);

    $value = div()->value('RAD')->p(2, 2, 2, 2)->renderToString();
    $toBe = terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0m§§RAD§§§§§§§§§§§§§§§" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL;
    expect($value)->toBe($toBe);

    $value = div()->value('RAD')->p(2)->renderToString();
    $toBe = terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0m§§RAD§§§§§§§§§§§§§§§" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL;
    expect($value)->toBe($toBe);

    $value = div()->value('RAD')->p2()->renderToString();
    $toBe = terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0m§§RAD§§§§§§§§§§§§§§§" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL;
    expect($value)->toBe($toBe);
});

test('test py', function (): void {
    putenv('COLUMNS=40');
    
    $value = div()->value('RAD')->py(2)->renderToString();
    $toBe = terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0mRAD§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL;
    expect($value)->toBe($toBe);
});

test('test magic py', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->py2()->renderToString();

    $toBe = terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0mRAD§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL;
    expect($value)->toBe($toBe);
});

test('test pt', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->pt2()->renderToString();
    $toBe = terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0mRAD§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . PHP_EOL;
    expect($value)->toBe($toBe);
});

test('test magic pt', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->pt2()->renderToString();
    $toBe = terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0m§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . terminal()->getCsi() . "0m" . PHP_EOL .
            terminal()->getCsi() . "0mRAD§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§" . PHP_EOL;
    expect($value)->toBe($toBe);
});

test('test px', function (): void {
    $value = div()->value('RAD')->px(10)->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m§§§§§§§§§§RAD§§§§§§§" . PHP_EOL);
});

test('test magic px', function (): void {
    $value = div()->value('RAD')->px10()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m§§§§§§§§§§RAD§§§§§§§" . PHP_EOL);
});

test('test pr', function (): void {
    $value = div()->value('RAD')->pr(10)->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0mRAD§§§§§§§§§§§§§§§§§" . PHP_EOL);
});

test('test magic pr', function (): void {
    $value = div()->value('RAD')->pr10()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0mRAD§§§§§§§§§§§§§§§§§" . PHP_EOL);
});

test('test pl', function (): void {
    $value = div()->value('RAD')->pl(10)->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m§§§§§§§§§§RAD§§§§§§§" . PHP_EOL);
});

test('test magic pl', function (): void {
    $value = div()->value('RAD')->pl10()->renderToString();
    expect($value)->toBe(terminal()->getCsi() . "0m§§§§§§§§§§RAD§§§§§§§" . PHP_EOL);
});

test('test font block', function (): void {
    $value = div()->value('RAD')->font('block')->renderToString();
    
    $message = 
    "\e[0m██████╗   █████╗  ██████╗  " . PHP_EOL .
    "\e[0m██╔══██╗ ██╔══██╗ ██╔══██╗ " . PHP_EOL .
    "\e[0m██████╔╝ ███████║ ██║  ██║ " . PHP_EOL .
    "\e[0m██╔══██╗ ██╔══██║ ██║  ██║ " . PHP_EOL .
    "\e[0m██║  ██║ ██║  ██║ ██████╔╝ " . PHP_EOL .
    "\e[0m╚═╝  ╚═╝ ╚═╝  ╚═╝ ╚═════╝  " . PHP_EOL;

    expect($value)->toBe($message);
});

test('test font block with font letter spacing', function (): void {
    $value = div()->value('RAD')->font('block')->fontLetterSpacing(3)->renderToString();
    
    $message = 
    "\e[0m██████╗     █████╗    ██████╗    " . PHP_EOL .
    "\e[0m██╔══██╗   ██╔══██╗   ██╔══██╗   " . PHP_EOL .
    "\e[0m██████╔╝   ███████║   ██║  ██║   " . PHP_EOL .
    "\e[0m██╔══██╗   ██╔══██║   ██║  ██║   " . PHP_EOL .
    "\e[0m██║  ██║   ██║  ██║   ██████╔╝   " . PHP_EOL .
    "\e[0m╚═╝  ╚═╝   ╚═╝  ╚═╝   ╚═════╝    " . PHP_EOL;

    expect($value)->toBe($message);
});


test('test colors', function (): void {
    $value = div()->colors('red', 'green', 'blue');

    expect($value->getStyles()['colors'][0])->toBe('red');
    expect($value->getStyles()['colors'][1])->toBe('green');
    expect($value->getStyles()['colors'][2])->toBe('blue');
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

    expect((string) $value)->toBe(terminal()->getCsi() . "0mRAD§§§§§§§§§§§§§§§§§" . PHP_EOL);
});

test('test getShortcodes', function (): void {
    $this->assertInstanceOf(Shortcodes::class, div()::getShortcodes());
});

test('test setShortcodes', function (): void {
    div()::setShortcodes(div()::getShortcodes());
    $this->assertInstanceOf(Shortcodes::class, div()::getShortcodes());
});

test('test textOverflow', function (): void {
    $element = div()->value('Thermage - Totally RAD Terminal styling for PHP!')->textOverflowHidden()->renderToString();
    expect($element)->toBe(terminal()->getCsi() . "0mThermage - Totally R" . PHP_EOL);

    $element = div()->value('Thermage - Totally RAD Terminal styling for PHP!')->textOverflowEllipsis()->renderToString();
    expect($element)->toBe(terminal()->getCsi() . "0mThermage - Totall..." . PHP_EOL);

    $element = div()->value('Thermage - Totally RAD Terminal styling for PHP!')->textOverflowClip()->renderToString();
    $result3 = 
    terminal()->getCsi() . "0mThermage - Totally§§" . PHP_EOL .
    terminal()->getCsi() . "0mRAD Terminal styling" . PHP_EOL .
    terminal()->getCsi() . "0mfor PHP!§§§§§§§§§§§§" . PHP_EOL;
    expect($element)->toBe($result3);
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