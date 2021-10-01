<?php

declare(strict_types=1);

use Clirad\Clirad;
use Clirad\Components\Element;
use Symfony\Component\Console\Output\ConsoleOutput as Renderer;
use Symfony\Component\Console\Output\BufferedOutput;

test('test el helper', function (): void {
    $this->assertInstanceOf(Element::class, el());
});

test('test render', function (): void {
    $value = el('RAD')->render();
    expect($value)->toEqual('RAD'); 
});

test('test color', function (): void {
    $value = el('RAD')->color('blue')->render();
    expect($value)->toBe('<fg=blue;>RAD</>'); 
});

test('test magic color', function (): void {
    $value = el('RAD')->colorBlue()->render();
    expect($value)->toBe('<fg=blue;>RAD</>'); 
});

test('test bg', function (): void {
    $value = el('RAD')->bg('blue')->render();
    expect($value)->toBe('<bg=blue;>RAD</>'); 
});

test('test magic bg', function (): void {
    $value = el('RAD')->bgBlue()->render();
    expect($value)->toBe('<bg=blue;>RAD</>'); 
});

test('test bold', function (): void {
    $value = el('RAD')->bold()->render();
    expect($value)->toBe('<options=bold;>RAD</>'); 
});

test('test underscore', function (): void {
    $value = el('RAD')->underscore()->render();
    expect($value)->toBe('<options=underscore;>RAD</>'); 
});

test('test underline', function (): void {
    $value = el('RAD')->underline()->render();
    expect($value)->toBe('<options=underscore;>RAD</>'); 
});

test('test blink', function (): void {
    $value = el('RAD')->blink()->render();
    expect($value)->toBe('<options=blink;>RAD</>'); 
});

test('test reverse', function (): void {
    $value = el('RAD')->reverse()->render();
    expect($value)->toBe('<options=reverse;>RAD</>'); 
});

test('test conceal', function (): void {
    $value = el('RAD')->conceal()->render();
    expect($value)->toBe('<options=conceal;>RAD</>'); 
});

test('test value and getValue', function (): void {
    $value = el()->value('RAD');
    expect($value->render())->toBe('RAD'); 
    expect($value->getValue()->toString())->toBe('RAD'); 
});

test('test properties and getProperties', function (): void {
    $value = el()->properties(['RAD']);
    expect($value->getProperties()->toArray())->toBe(['RAD']); 
});

test('test mx', function (): void {
    $value = el('RAD')->mx(10)->render();
    expect($value)->toBe('     RAD     '); 
});

test('test magic mx', function (): void {
    $value = el('RAD')->mx10()->render();
    expect($value)->toBe('     RAD     '); 
});

test('test mr', function (): void {
    $value = el('RAD')->mr(10)->render();
    expect($value)->toBe('RAD          '); 
});

test('test magic mr', function (): void {
    $value = el('RAD')->mr10()->render();
    expect($value)->toBe('RAD          '); 
});

test('test ml', function (): void {
    $value = el('RAD')->ml(10)->render();
    expect($value)->toBe('          RAD'); 
});

test('test magic ml', function (): void {
    $value = el('RAD')->ml10()->render();
    expect($value)->toBe('          RAD'); 
});

test('test px', function (): void {
    $value = el('RAD')->px(10)->render();
    expect($value)->toBe('     RAD     '); 
});

test('test magic px', function (): void {
    $value = el('RAD')->px10()->render();
    expect($value)->toBe('     RAD     '); 
});

test('test pr', function (): void {
    $value = el('RAD')->pr(10)->render();
    expect($value)->toBe('RAD          '); 
});

test('test magic pr', function (): void {
    $value = el('RAD')->pr10()->render();
    expect($value)->toBe('RAD          '); 
});

test('test pl', function (): void {
    $value = el('RAD')->pl(10)->render();
    expect($value)->toBe('          RAD'); 
});

test('test magic pl', function (): void {
    $value = el('RAD')->pl10()->render();
    expect($value)->toBe('          RAD'); 
});

test('test lower', function (): void {
    $value = el('RAD')->lower()->render();
    expect($value)->toBe('rad'); 
});

test('test upper', function (): void {
    $value = el('rad')->upper()->render();
    expect($value)->toBe('RAD'); 
});

test('test camel', function (): void {
    $value = el('RaD')->camel()->render();
    expect($value)->toBe('raD'); 
});

test('test capitalize', function (): void {
    $value = el('RAD')->capitalize()->render();
    expect($value)->toBe('Rad'); 
});

test('test getRenderer', function (): void {
    $value = el()->getRenderer();
    $this->assertInstanceOf(Renderer::class, $value);
});

test('magic throw exception BadMethodCallException', function (): void {
    el()->foo();
})->throws(BadMethodCallException::class);

test('test magic __toString', function (): void {
    $value = el('RAD');
    expect((string) $value)->toBe('RAD'); 
});

test('test limit', function (): void {
    $value = el('RAD')->limit(1)->render();
    expect($value)->toBe('R...'); 

    $value = el('RAD')->limit(1, '')->render();
    expect($value)->toBe('R'); 
});

test('test repeat', function (): void {
    $value = el('RAD')->repeat(3)->render();
    expect($value)->toBe('RADRADRAD'); 
});

test('test display', function (): void {
    Clirad::setRenderer($output = new BufferedOutput());
    $value = el('RAD')->display();
    expect($output->fetch())->toBe("RAD\n"); 

    $value = el('RAD')->display('col');
    expect($output->fetch())->toBe("RAD"); 

    $value = el('RAD')->display('row');
    expect($output->fetch())->toBe("RAD\n");  

    $value = el('RAD')->display('none');
    expect($output->fetch())->toBe(""); 
});

test('test magic display', function (): void {
    Clirad::setRenderer($output = new BufferedOutput());
    $value = el('RAD')->displayCol();
    expect($output->fetch())->toBe("RAD"); 

    $value = el('RAD')->displayRow();
    expect($output->fetch())->toBe("RAD\n");  

    $value = el('RAD')->displayNone();
    expect($output->fetch())->toBe(""); 
});
