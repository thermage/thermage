<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Components\Block;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\ConsoleOutput as Renderer;

test('test termage block method', function (): void {
    $this->assertInstanceOf(Block::class, termage()->block());
});

test('test render', function (): void {
    $value = termage()->block()->value('RAD')->render();
    expect($value)->toEqual('RAD');
});

test('test color', function (): void {
    $value = termage()->block()->value('RAD')->color('blue')->render();
    expect($value)->toBe('<fg=blue;>RAD</>');
});

test('test magic color', function (): void {
    $value = termage()->block()->value('RAD')->colorBlue()->render();
    expect($value)->toBe('<fg=blue;>RAD</>');
});

test('test bg', function (): void {
    $value = termage()->block()->value('RAD')->bg('blue')->render();
    expect($value)->toBe('<bg=blue;>RAD</>');
});

test('test magic bg', function (): void {
    $value = termage()->block()->value('RAD')->bgBlue()->render();
    expect($value)->toBe('<bg=blue;>RAD</>');
});

test('test bold', function (): void {
    $value = termage()->block()->value('RAD')->bold()->render();
    expect($value)->toBe('<options=bold;>RAD</>');
});

test('test underscore', function (): void {
    $value = termage()->block()->value('RAD')->underscore()->render();
    expect($value)->toBe('<options=underscore;>RAD</>');
});

test('test underline', function (): void {
    $value = termage()->block()->value('RAD')->underline()->render();
    expect($value)->toBe('<options=underscore;>RAD</>');
});

test('test blink', function (): void {
    $value = termage()->block()->value('RAD')->blink()->render();
    expect($value)->toBe('<options=blink;>RAD</>');
});

test('test reverse', function (): void {
    $value = termage()->block()->value('RAD')->reverse()->render();
    expect($value)->toBe('<options=reverse;>RAD</>');
});

test('test conceal', function (): void {
    $value = termage()->block()->value('RAD')->conceal()->render();
    expect($value)->toBe('<options=conceal;>RAD</>');
});

test('test value and getValue', function (): void {
    $value = termage()->block()->value('RAD');
    expect($value->render())->toBe('RAD');
    expect($value->getValue()->toString())->toBe('RAD');
});

test('test properties and getProperties', function (): void {
    $value = termage()->block()->properties(['RAD']);
    expect($value->getProperties()->toArray())->toBe(['RAD']);
});

test('test mx', function (): void {
    $value = termage()->block()->value('RAD')->mx(10)->render();
    expect($value)->toBe('     RAD     ');
});

test('test magic mx', function (): void {
    $value = termage()->block()->value('RAD')->mx10()->render();
    expect($value)->toBe('     RAD     ');
});

test('test mr', function (): void {
    $value = termage()->block()->value('RAD')->mr(10)->render();
    expect($value)->toBe('RAD          ');
});

test('test magic mr', function (): void {
    $value = termage()->block()->value('RAD')->mr10()->render();
    expect($value)->toBe('RAD          ');
});

test('test ml', function (): void {
    $value = termage()->block()->value('RAD')->ml(10)->render();
    expect($value)->toBe('          RAD');
});

test('test magic ml', function (): void {
    $value = termage()->block()->value('RAD')->ml10()->render();
    expect($value)->toBe('          RAD');
});

test('test px', function (): void {
    $value = termage()->block()->value('RAD')->px(10)->render();
    expect($value)->toBe('     RAD     ');
});

test('test magic px', function (): void {
    $value = termage()->block()->value('RAD')->px10()->render();
    expect($value)->toBe('     RAD     ');
});

test('test pr', function (): void {
    $value = termage()->block()->value('RAD')->pr(10)->render();
    expect($value)->toBe('RAD          ');
});

test('test magic pr', function (): void {
    $value = termage()->block()->value('RAD')->pr10()->render();
    expect($value)->toBe('RAD          ');
});

test('test pl', function (): void {
    $value = termage()->block()->value('RAD')->pl(10)->render();
    expect($value)->toBe('          RAD');
});

test('test magic pl', function (): void {
    $value = termage()->block()->value('RAD')->pl10()->render();
    expect($value)->toBe('          RAD');
});

test('test lower', function (): void {
    $value = termage()->block()->value('RAD')->lower()->render();
    expect($value)->toBe('rad');
});

test('test upper', function (): void {
    $value = termage()->block()->value('rad')->upper()->render();
    expect($value)->toBe('RAD');
});

test('test camel', function (): void {
    $value = termage()->block()->value('RaD')->camel()->render();
    expect($value)->toBe('raD');
});

test('test capitalize', function (): void {
    $value = termage()->block()->value('RAD')->capitalize()->render();
    expect($value)->toBe('Rad');
});

test('test getRenderer', function (): void {
    $value = termage()->block()->getRenderer();
    $this->assertInstanceOf(Renderer::class, $value);
});

test('test renderer', function (): void {
    $value = termage()->block()->renderer(new BufferedOutput());
    $this->assertInstanceOf(BufferedOutput::class, $value->getRenderer());
});

test('magic throw exception BadMethodCallException', function (): void {
    termage()->block()->foo();
})->throws(BadMethodCallException::class);

test('test magic __toString', function (): void {
    $value = termage()->block()->value('RAD');
    expect((string) $value)->toBe('RAD');
});

test('test limit', function (): void {
    $value = termage()->block()->value('RAD')->limit(1)->render();
    expect($value)->toBe('R...');

    $value = termage()->block()->value('RAD')->limit(1, '')->render();
    expect($value)->toBe('R');
});

test('test repeat', function (): void {
    $value = termage()->block()->value('RAD')->repeat(3)->render();
    expect($value)->toBe('RADRADRAD');
});

test('test display', function (): void {
    $output = new BufferedOutput();
    $value = termage($output)->block()->value('RAD')->display();

    expect($output->fetch())->toBe("RAD\n");

    $value = termage($output)->block()->value('RAD')->display('col');
    expect($output->fetch())->toBe('RAD');

    $value = termage($output)->block()->value('RAD')->display('row');
    expect($output->fetch())->toBe("RAD\n");

    $value = termage($output)->block()->value('RAD')->display('none');
    expect($output->fetch())->toBe('');
});

test('test magic display', function (): void {
    $output = new BufferedOutput();

    $value = termage($output)->block()->value('RAD')->displayCol();

    expect($output->fetch())->toBe('RAD');

    $value = termage($output)->block()->value('RAD')->displayRow();
    expect($output->fetch())->toBe("RAD\n");

    $value = termage($output)->block()->value('RAD')->displayNone();
    expect($output->fetch())->toBe('');
});
