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
use function Thermage\getCsi;
use Thermage\Parsers\Shortcodes;

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
    $value = div('RAD')->color('blue')->render();
    expect($value)->toBe(getCsi() . "34m" . getCsi() . "0m" . getCsi() . "34mRAD                 " . getCsi() . "39m" . getCsi() . "39m" . PHP_EOL);
});

test('test magic color', function (): void {
    $value = div()->value('RAD')->colorBlue()->render(); 
    expect($value)->toBe(getCsi() . "34m" . getCsi() . "0m" . getCsi() . "34mRAD                 " . getCsi() . "39m" . getCsi() . "39m". PHP_EOL);
});

test('test bg', function (): void {
    $value = div()->value('RAD')->bg('blue')->render();    
    expect($value)->toBe(getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44mRAD                 " . getCsi() . "49m" . getCsi() . "49m" . PHP_EOL);
});

test('test magic bg', function (): void {
    $value = div()->value('RAD')->bgBlue()->render();
    expect($value)->toBe(getCsi() . "44m" . getCsi() . "0m" . getCsi() . "44mRAD                 " . getCsi() . "49m" . getCsi() . "49m" . PHP_EOL);
});

test('test bold', function (): void {
    $value = div()->value('RAD')->bold()->render();
    expect($value)->toBe(getCsi() . "0m" . getCsi() . "1mRAD" . getCsi() . "22m                 " . PHP_EOL);
});

test('test underline', function (): void {
    $value = div()->value('RAD')->underline()->render();
    expect($value)->toBe(getCsi() . "0m" . getCsi() . "4mRAD" . getCsi() . "24m                 " . PHP_EOL);
});

test('test blink', function (): void {
    $value = div()->value('RAD')->blink()->render();
    expect($value)->toBe(getCsi() . "0m" . getCsi() . "5mRAD" . getCsi() . "25m                 " . PHP_EOL);
});

test('test italic', function (): void {
    $value = div()->value('RAD')->italic()->render();
    expect($value)->toBe(getCsi() . "0m" . getCsi() . "3mRAD" . getCsi() . "23m                 " . PHP_EOL);
});

test('test dim', function (): void {
    $value = div()->value('RAD')->dim()->render();
    expect($value)->toBe(getCsi() . "0m" . getCsi() . "2mRAD" . getCsi() . "22m                 " . PHP_EOL);
});

test('test strikethrough', function (): void {
    $value = div()->value('RAD')->strikethrough()->render();
    expect($value)->toBe(getCsi() . "0m" . getCsi() . "9mRAD" . getCsi() . "29m                 ". PHP_EOL);
});

test('test reverse', function (): void {
    $value = div()->value('RAD')->reverse()->render();
    expect($value)->toBe(getCsi() . "0m" . getCsi() . "7mRAD" . getCsi() . "27m                 " . PHP_EOL);
});

test('test invisible', function (): void {
    $value = div()->value('RAD')->invisible()->render();
    expect($value)->toBe(getCsi() . "0m" . getCsi() . "8mRAD" . getCsi() . "28m                 " . PHP_EOL);
});

test('test value and getValue', function (): void {
    $div = div()->value('RAD');
    expect($div->render())->toBe(getCsi() . "0mRAD                 " . PHP_EOL);
    expect($div->getValue())->toBe(getCsi() . "0mRAD                 " . PHP_EOL);
});

test('test classes and getClasses', function (): void {
    $value = div()->classes('RAD');
    expect($value->getClasses())->toBe('RAD');
});

test('test m', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->m(0, 10, 0, 10)->render();
    expect($value)->toBe(getCsi() . "0m          RAD                 " . PHP_EOL);

    $value = div()->value('RAD')->m(2, 2, 2, 2)->render();

    expect($value)->toBe(PHP_EOL . PHP_EOL . getCsi() . "0m  RAD                                 " . PHP_EOL . PHP_EOL . PHP_EOL);

    $value = div()->value('RAD')->m(2)->render();
    expect($value)->toBe(PHP_EOL . PHP_EOL . getCsi() . "0m  RAD                                 " . PHP_EOL . PHP_EOL . PHP_EOL);

    $value = div()->value('RAD')->m2()->render();
    expect($value)->toBe(PHP_EOL . PHP_EOL . getCsi() . "0m  RAD                                 " . PHP_EOL . PHP_EOL . PHP_EOL);
});

test('test my', function (): void {
    putenv('COLUMNS=40');
    
    $value = div()->value('RAD')->my(2)->render();
    expect($value)->toBe(PHP_EOL . PHP_EOL . getCsi() . "0mRAD                                     " . PHP_EOL . PHP_EOL . PHP_EOL);
});

test('test magic my', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->my2()->render();

    expect($value)->toBe(PHP_EOL . PHP_EOL . getCsi() . "0mRAD                                     " . PHP_EOL . PHP_EOL . PHP_EOL);
});

test('test mx', function (): void {
    putenv('COLUMNS=40');
    
    $value = div()->value('RAD')->mx(10)->render();
    expect($value)->toBe(getCsi() . "0m          RAD                 " . PHP_EOL);
});

test('test magic mx', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->mx10()->render();
    expect($value)->toBe(getCsi() . "0m          RAD                 " . PHP_EOL);
});

test('test mr', function (): void {
    $value = div()->value('RAD')->mr(10)->render();
    expect($value)->toBe(getCsi() . "0mRAD       " . PHP_EOL);
});

test('test magic mr', function (): void {
    $value = div()->value('RAD')->mr10()->render();
    expect($value)->toBe(getCsi() . "0mRAD       " . PHP_EOL);
});

test('test ml', function (): void {
    $value = div()->value('RAD')->ml(10)->render();
    expect($value)->toBe(getCsi() . "0m          RAD       " . PHP_EOL);
});

test('test clearfix', function (): void {
    $value = div(
        div('Stay').
        div('RAD')
    )->clearfix()->render();
    expect($value)->toBe(getCsi() . "0mStay                " . PHP_EOL . getCsi() . "0mRAD                 " . PHP_EOL);

    $value = div(
        div(span('Stay').span('RAD')).
        div('!')
    )->clearfix()->render();

    expect($value)->toBe(getCsi() . "0mStayRAD             " . PHP_EOL . getCsi() . "0m!                   " . PHP_EOL);
});

test('test magic ml', function (): void {
    $value = div()->value('RAD')->ml10()->render();
    expect($value)->toBe(getCsi() . "0m          RAD       " . PHP_EOL);
});

test('test mt', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->mt2()->render();
    $toBe =  PHP_EOL .
             PHP_EOL .
            getCsi() . "0mRAD                                     " . PHP_EOL;
    expect($value)->toBe($toBe);
});

test('test magic mt', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->mt2()->render();
    $toBe =  PHP_EOL .
             PHP_EOL .
            getCsi() . "0mRAD                                     " . PHP_EOL;
    expect($value)->toBe($toBe);
});

test('test p', function (): void {
    $value = div()->value('RAD')->p(0, 10, 0, 10)->render();
    expect($value)->toBe(getCsi() . "0m          RAD       " . PHP_EOL);

    $value = div()->value('RAD')->p(2, 2, 2, 2)->render();
    $toBe = getCsi() . "0m                    " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0m                    " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0m  RAD               " . PHP_EOL .
            getCsi() . "0m                    " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0m                    " . getCsi() . "0m" . PHP_EOL;
    expect($value)->toBe($toBe);

    $value = div()->value('RAD')->p(2)->render();
    $toBe = getCsi() . "0m                    " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0m                    " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0m  RAD               " . PHP_EOL .
            getCsi() . "0m                    " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0m                    " . getCsi() . "0m" . PHP_EOL;
    expect($value)->toBe($toBe);

    $value = div()->value('RAD')->p2()->render();
    $toBe = getCsi() . "0m                    " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0m                    " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0m  RAD               " . PHP_EOL .
            getCsi() . "0m                    " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0m                    " . getCsi() . "0m" . PHP_EOL;
    expect($value)->toBe($toBe);
});

test('test py', function (): void {
    putenv('COLUMNS=40');
    
    $value = div()->value('RAD')->py(2)->render();
    $toBe = getCsi() . "0m                                        " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0m                                        " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0mRAD                                     " . PHP_EOL .
            getCsi() . "0m                                        " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0m                                        " . getCsi() . "0m" . PHP_EOL;
    expect($value)->toBe($toBe);
});

test('test magic py', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->py2()->render();
    $toBe = getCsi() . "0m                                        " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0m                                        " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0mRAD                                     " . PHP_EOL .
            getCsi() . "0m                                        " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0m                                        " . getCsi() . "0m" . PHP_EOL;
    expect($value)->toBe($toBe);
});

test('test pt', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->pt2()->render();
    $toBe = getCsi() . "0m                                        " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0m                                        " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0mRAD                                     " . PHP_EOL;
    expect($value)->toBe($toBe);
});

test('test magic pt', function (): void {
    putenv('COLUMNS=40');

    $value = div()->value('RAD')->pt2()->render();
    $toBe = getCsi() . "0m                                        " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0m                                        " . getCsi() . "0m" . PHP_EOL .
            getCsi() . "0mRAD                                     " . PHP_EOL;
    expect($value)->toBe($toBe);
});

test('test px', function (): void {
    $value = div()->value('RAD')->px(10)->render();
    expect($value)->toBe(getCsi() . "0m          RAD       " . PHP_EOL);
});

test('test magic px', function (): void {
    $value = div()->value('RAD')->px10()->render();
    expect($value)->toBe(getCsi() . "0m          RAD       " . PHP_EOL);
});

test('test pr', function (): void {
    $value = div()->value('RAD')->pr(10)->render();
    expect($value)->toBe(getCsi() . "0mRAD                 " . PHP_EOL);
});

test('test magic pr', function (): void {
    $value = div()->value('RAD')->pr10()->render();
    expect($value)->toBe(getCsi() . "0mRAD                 " . PHP_EOL);
});

test('test pl', function (): void {
    $value = div()->value('RAD')->pl(10)->render();
    expect($value)->toBe(getCsi() . "0m          RAD       " . PHP_EOL);
});

test('test magic pl', function (): void {
    $value = div()->value('RAD')->pl10()->render();
    expect($value)->toBe(getCsi() . "0m          RAD       " . PHP_EOL);
});

test('test font block', function (): void {
    $value = div()->value('RAD')->font('block')->render();
    
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
    $value = div()->value('RAD')->font('block')->fontLetterSpacing(3)->render();
    
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

    expect((string) $value)->toBe(getCsi() . "0mRAD                 " . PHP_EOL);
});

test('test getShortcodes', function (): void {
    $this->assertInstanceOf(Shortcodes::class, div()::getShortcodes());
});

test('test setShortcodes', function (): void {
    div()::setShortcodes(div()::getShortcodes());
    $this->assertInstanceOf(Shortcodes::class, div()::getShortcodes());
});

test('test textOverflow', function (): void {
    $element = div()->value('Thermage - Totally RAD Terminal styling for PHP!')->textOverflowHidden()->render();
    expect($element)->toBe(getCsi() . "0mThermage - Totally R" . PHP_EOL);

    $element = div()->value('Thermage - Totally RAD Terminal styling for PHP!')->textOverflowEllipsis()->render();
    expect($element)->toBe(getCsi() . "0mThermage - Totall..." . PHP_EOL);

    $element = div()->value('Thermage - Totally RAD Terminal styling for PHP!')->textOverflowClip()->render();
    expect($element)->toBe(getCsi() . "0mThermage - Totally  " . PHP_EOL . getCsi() . "0mRAD Terminal styling" . PHP_EOL . getCsi() . "0mfor PHP!            " . PHP_EOL);
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