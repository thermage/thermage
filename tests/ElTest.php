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
    expect($value)->toEqual('RAD');
});

test('test color', function (): void {
    $value = termage()->el()->value('RAD')->color('blue')->render();
    expect($value)->toBe('<fg=blue;>RAD</>');
});

test('test magic color', function (): void {
    $value = termage()->el()->value('RAD')->colorBlue()->render();
    expect($value)->toBe('<fg=blue;>RAD</>');
});

test('test bg', function (): void {
    $value = termage()->el()->value('RAD')->bg('blue')->render();
    expect($value)->toBe('<bg=blue;>RAD</>');
});

test('test magic bg', function (): void {
    $value = termage()->el()->value('RAD')->bgBlue()->render();
    expect($value)->toBe('<bg=blue;>RAD</>');
});

test('test bold', function (): void {
    $value = termage()->el()->value('RAD')->bold()->render();
    expect($value)->toBe('<options=bold;>RAD</>');
});

test('test underscore', function (): void {
    $value = termage()->el()->value('RAD')->underscore()->render();
    expect($value)->toBe('<options=underscore;>RAD</>');
});

test('test underline', function (): void {
    $value = termage()->el()->value('RAD')->underline()->render();
    expect($value)->toBe('<options=underscore;>RAD</>');
});

test('test blink', function (): void {
    $value = termage()->el()->value('RAD')->blink()->render();
    expect($value)->toBe('<options=blink;>RAD</>');
});

test('test reverse', function (): void {
    $value = termage()->el()->value('RAD')->reverse()->render();
    expect($value)->toBe('<options=reverse;>RAD</>');
});

test('test conceal', function (): void {
    $value = termage()->el()->value('RAD')->conceal()->render();
    expect($value)->toBe('<options=conceal;>RAD</>');
});

test('test value and getValue', function (): void {
    $value = termage()->el()->value('RAD');
    expect($value->render())->toBe('RAD');
    expect($value->getValue()->toString())->toBe('RAD');
});

test('test properties and getProperties', function (): void {
    $value = termage()->el()->properties(['RAD']);
    expect($value->getProperties()->toArray())->toBe(['RAD']);
});

test('test mx', function (): void {
    $value = termage()->el()->value('RAD')->mx(10)->render();
    expect($value)->toBe('     RAD     ');
});

test('test magic mx', function (): void {
    $value = termage()->el()->value('RAD')->mx10()->render();
    expect($value)->toBe('     RAD     ');
});

test('test mr', function (): void {
    $value = termage()->el()->value('RAD')->mr(10)->render();
    expect($value)->toBe('RAD          ');
});

test('test magic mr', function (): void {
    $value = termage()->el()->value('RAD')->mr10()->render();
    expect($value)->toBe('RAD          ');
});

test('test ml', function (): void {
    $value = termage()->el()->value('RAD')->ml(10)->render();
    expect($value)->toBe('          RAD');
});

test('test magic ml', function (): void {
    $value = termage()->el()->value('RAD')->ml10()->render();
    expect($value)->toBe('          RAD');
});

test('test px', function (): void {
    $value = termage()->el()->value('RAD')->px(10)->render();
    expect($value)->toBe('     RAD     ');
});

test('test magic px', function (): void {
    $value = termage()->el()->value('RAD')->px10()->render();
    expect($value)->toBe('     RAD     ');
});

test('test pr', function (): void {
    $value = termage()->el()->value('RAD')->pr(10)->render();
    expect($value)->toBe('RAD          ');
});

test('test magic pr', function (): void {
    $value = termage()->el()->value('RAD')->pr10()->render();
    expect($value)->toBe('RAD          ');
});

test('test pl', function (): void {
    $value = termage()->el()->value('RAD')->pl(10)->render();
    expect($value)->toBe('          RAD');
});

test('test magic pl', function (): void {
    $value = termage()->el()->value('RAD')->pl10()->render();
    expect($value)->toBe('          RAD');
});

test('test lower', function (): void {
    $value = termage()->el()->value('RAD')->lower()->render();
    expect($value)->toBe('rad');
});

test('test upper', function (): void {
    $value = termage()->el()->value('rad')->upper()->render();
    expect($value)->toBe('RAD');
});

test('test camel', function (): void {
    $value = termage()->el()->value('RaD')->camel()->render();
    expect($value)->toBe('raD');
});

test('test capitalize', function (): void {
    $value = termage()->el()->value('RAD')->capitalize()->render();
    expect($value)->toBe('Rad');
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
    expect((string) $value)->toBe('RAD');
});

test('test limit', function (): void {
    $value = termage()->el()->value('RAD')->limit(1)->render();
    expect($value)->toBe('R...');

    $value = termage()->el()->value('RAD')->limit(1, '')->render();
    expect($value)->toBe('R');
});

test('test repeat', function (): void {
    $value = termage()->el()->value('RAD')->repeat(3)->render();
    expect($value)->toBe('RADRADRAD');
});

test('test getComponentProperties', function (): void {
    $properties = termage()->el()->getComponentProperties();
    expect($properties)->toBeArray();
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
