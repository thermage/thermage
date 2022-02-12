<?php

declare(strict_types=1);

use Thermage\Thermage;
use Thermage\Base\Element;
use function Thermage\heading;

beforeEach(function() {
    putenv('COLUMNS=20');
});

test('test heading size < 1', function (): void {
    $value = heading('RAD')->size0()->renderToString();
    expect(str_replace([PHP_EOL, Element::getSpace()], "", $value))->toBe("\e[0m╔══════════════════╗\e[0m\e[0m║\e[1mRAD\e[22m║\e[0m╚══════════════════╝\e[0m");
});

test('test heading size 1', function (): void {
    $value = heading('RAD')->size1()->renderToString();
    expect(str_replace([PHP_EOL, Element::getSpace()], "", $value))->toBe("\e[0m╔══════════════════╗\e[0m\e[0m║\e[1mRAD\e[22m║\e[0m╚══════════════════╝\e[0m");
});

test('test heading size 2', function (): void {
    $value = heading('RAD')->size2()->renderToString();
    expect(str_replace([PHP_EOL, Element::getSpace()], "", $value))->toBe("\e[0m┏━━━━━━━━━━━━━━━━━━┓\e[0m\e[0m┃\e[1mRAD\e[22m┃\e[0m┗━━━━━━━━━━━━━━━━━━┛\e[0m");
});

test('test heading size 3', function (): void {
    $value = heading('RAD')->size3()->renderToString();
    expect(str_replace([PHP_EOL, Element::getSpace()], "", $value))->toBe("\e[0m┌──────────────────┐\e[0m\e[0m│RAD│\e[0m└──────────────────┘\e[0m");
});

test('test heading size 4', function (): void {
    $value = heading('RAD')->size4()->renderToString();
    expect(str_replace([PHP_EOL, Element::getSpace()], "", $value))->toBe("\e[0m\e[1mRAD\e[22m");
});

test('test heading size 5', function (): void {
    $value = heading('RAD')->size5()->renderToString();
    expect(str_replace([PHP_EOL, Element::getSpace()], "", $value))->toBe("\e[0m\e[2mRAD\e[22m");
});

test('test heading size > 5', function (): void {
    $value = heading('RAD')->size6()->renderToString();
    expect(str_replace([PHP_EOL, Element::getSpace()], "", $value))->toBe("\e[0m\e[2mRAD\e[22m");
});