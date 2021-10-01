<?php

declare(strict_types=1);

use Clirad\Clirad;
use Clirad\Components\Element;
use Symfony\Component\Console\Output\ConsoleOutput as Renderer;

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

test('test bg', function (): void {
    $value = el('RAD')->bg('blue')->render();
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