<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Base\Theme;
use Termage\Components\El;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\ConsoleOutput as Renderer;

test('test termage el method', function (): void {
    $this->assertInstanceOf(El::class, termage()->el());
});

test('test render', function (): void {
    $value = termage()->el()->value('RAD')->render();
    expect($value)->toEqual('[m l=0 r=0][p l=0 r=0]RAD[/p][/m]');
});

test('test color', function (): void {
    $value = termage()->el()->value('RAD')->color('blue')->render();
    expect($value)->toBe('[m l=0 r=0][color=blue][p l=0 r=0]RAD[/p][/color][/m]');
});

test('test magic color', function (): void {
    $value = termage()->el()->value('RAD')->colorBlue()->render();
    expect($value)->toBe('[m l=0 r=0][color=blue][p l=0 r=0]RAD[/p][/color][/m]');
});

test('test bg', function (): void {
    $value = termage()->el()->value('RAD')->bg('blue')->render();
    expect($value)->toBe('[m l=0 r=0][bg=blue][p l=0 r=0]RAD[/p][/bg][/m]');
});

test('test magic bg', function (): void {
    $value = termage()->el()->value('RAD')->bgBlue()->render();
    expect($value)->toBe('[m l=0 r=0][bg=blue][p l=0 r=0]RAD[/p][/bg][/m]');
});

test('test bold', function (): void {
    $value = termage()->el()->value('RAD')->bold()->render();
    expect($value)->toBe('[m l=0 r=0][p l=0 r=0][b]RAD[/b][/p][/m]');
});

test('test underscore', function (): void {
    $value = termage()->el()->value('RAD')->underscore()->render();
    expect($value)->toBe('[m l=0 r=0][p l=0 r=0][u]RAD[/u][/p][/m]');
});

test('test underline', function (): void {
    $value = termage()->el()->value('RAD')->underline()->render();
    expect($value)->toBe('[m l=0 r=0][p l=0 r=0][u]RAD[/u][/p][/m]');
});

test('test blink', function (): void {
    $value = termage()->el()->value('RAD')->blink()->render();
    expect($value)->toBe('[m l=0 r=0][p l=0 r=0][blink]RAD[/blink][/p][/m]');
});

test('test italic', function (): void {
    $value = termage()->el()->value('RAD')->italic()->render();
    expect($value)->toBe('[m l=0 r=0][p l=0 r=0][i]RAD[/i][/p][/m]');
});

test('test strikethrough', function (): void {
    $value = termage()->el()->value('RAD')->strikethrough()->render();
    expect($value)->toBe('[m l=0 r=0][p l=0 r=0][s]RAD[/s][/p][/m]');
});

test('test reverse', function (): void {
    $value = termage()->el()->value('RAD')->reverse()->render();
    expect($value)->toBe('[m l=0 r=0][p l=0 r=0][reverse]RAD[/reverse][/p][/m]');
});

test('test invisible', function (): void {
    $value = termage()->el()->value('RAD')->invisible()->render();
    expect($value)->toBe('[m l=0 r=0][p l=0 r=0][invisible]RAD[/invisible][/p][/m]');
});

test('test value and getValue', function (): void {
    $value = termage()->el()->value('RAD');
    expect($value->render())->toBe('[m l=0 r=0][p l=0 r=0]RAD[/p][/m]');
    expect($value->getValue()->toString())->toBe('RAD');
});

test('test properties and getProperties', function (): void {
    $value = termage()->el()->properties(['RAD']);
    expect($value->getProperties()->toArray())->toBe(['RAD']);
});

test('test mx', function (): void {
    $value = termage()->el()->value('RAD')->mx(10)->render();
    expect($value)->toBe('[m l=5 r=5][p l=0 r=0]RAD[/p][/m]');
});

test('test magic mx', function (): void {
    $value = termage()->el()->value('RAD')->mx10()->render();
    expect($value)->toBe('[m l=5 r=5][p l=0 r=0]RAD[/p][/m]');
});

test('test mr', function (): void {
    $value = termage()->el()->value('RAD')->mr(10)->render();
    expect($value)->toBe('[m l=0 r=10][p l=0 r=0]RAD[/p][/m]');
});

test('test magic mr', function (): void {
    $value = termage()->el()->value('RAD')->mr10()->render();
    expect($value)->toBe('[m l=0 r=10][p l=0 r=0]RAD[/p][/m]');
});

test('test ml', function (): void {
    $value = termage()->el()->value('RAD')->ml(10)->render();
    expect($value)->toBe('[m l=10 r=0][p l=0 r=0]RAD[/p][/m]');
});

test('test magic ml', function (): void {
    $value = termage()->el()->value('RAD')->ml10()->render();
    expect($value)->toBe('[m l=10 r=0][p l=0 r=0]RAD[/p][/m]');
});

test('test px', function (): void {
    $value = termage()->el()->value('RAD')->px(10)->render();
    expect($value)->toBe('[m l=0 r=0][p l=5 r=5]RAD[/p][/m]');
});

test('test magic px', function (): void {
    $value = termage()->el()->value('RAD')->px10()->render();
    expect($value)->toBe('[m l=0 r=0][p l=5 r=5]RAD[/p][/m]');
});

test('test pr', function (): void {
    $value = termage()->el()->value('RAD')->pr(10)->render();
    expect($value)->toBe('[m l=0 r=0][p l=0 r=10]RAD[/p][/m]');
});

test('test magic pr', function (): void {
    $value = termage()->el()->value('RAD')->pr10()->render();
    expect($value)->toBe('[m l=0 r=0][p l=0 r=10]RAD[/p][/m]');
});

test('test pl', function (): void {
    $value = termage()->el()->value('RAD')->pl(10)->render();
    expect($value)->toBe('[m l=0 r=0][p l=10 r=0]RAD[/p][/m]');
});

test('test magic pl', function (): void {
    $value = termage()->el()->value('RAD')->pl10()->render();
    expect($value)->toBe('[m l=0 r=0][p l=10 r=0]RAD[/p][/m]');
});

test('test getOutput', function (): void {
    $value = termage()->el()->getOutput();
    $this->assertInstanceOf(Renderer::class, $value);
});

test('test getTheme', function (): void {
    $value = termage()->el()->getTheme();
    $this->assertInstanceOf(Theme::class, $value);
});

test('test output', function (): void {
    $value = termage()->el()->output(new BufferedOutput());
    $this->assertInstanceOf(BufferedOutput::class, $value->getOutput());
});

test('magic throw exception BadMethodCallException', function (): void {
    termage()->el()->foo();
})->throws(BadMethodCallException::class);

test('test magic __toString', function (): void {
    $value = termage()->el()->value('RAD');
    expect((string) $value)->toBe('[m l=0 r=0][p l=0 r=0]RAD[/p][/m]');
});


test('test display', function (): void {
    $output = new BufferedOutput();
    $value = termage($output)->el()->value('RAD')->display();

    expect($output->fetch())->toBe("RAD\n");

    $value = termage($output)->el()->value('RAD')->display('col');
    expect($output->fetch())->toBe('RAD');

    $value = termage($output)->el()->value('RAD')->display('row');
    expect($output->fetch())->toBe("RAD\n");

    $value = termage($output)->el()->value('RAD')->display('none');
    expect($output->fetch())->toBe('');
});

test('test magic display', function (): void {
    $output = new BufferedOutput();

    $value = termage($output)->el()->value('RAD')->displayCol();

    expect($output->fetch())->toBe('RAD');

    $value = termage($output)->el()->value('RAD')->displayRow();
    expect($output->fetch())->toBe("RAD\n");

    $value = termage($output)->el()->value('RAD')->displayNone();
    expect($output->fetch())->toBe('');
});
