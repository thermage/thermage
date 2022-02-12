<?php

declare(strict_types=1);

use Thermage\Base\Cursor;
use function Thermage\terminal;

test('test show', function (): void {
    expect(terminal()->cursor()->show())->toEqual(terminal()->getCsi() . '?25h');
});

test('test hide', function (): void {
    expect(terminal()->cursor()->hide())->toEqual(terminal()->getCsi() . '?25l');
});

test('test up', function (): void {
    expect(terminal()->cursor()->up(1))->toEqual(terminal()->getCsi() . "1A");
});

test('test upLine', function (): void {
    expect(terminal()->cursor()->upLine(1))->toEqual(terminal()->getCsi() . "1F");
});

test('test downLine', function (): void {
    expect(terminal()->cursor()->downLine(1))->toEqual(terminal()->getCsi() . "1E");
});

test('test down', function (): void {
    expect(terminal()->cursor()->down(1))->toEqual(terminal()->getCsi() . "1B");
});

test('test forward', function (): void {
    expect(terminal()->cursor()->forward(1))->toEqual(terminal()->getCsi() . "1C");
});

test('test back', function (): void {
    expect(terminal()->cursor()->back(1))->toEqual(terminal()->getCsi() . "1D");
});

test('test goTo', function (): void {
    expect(terminal()->cursor()->goTo(1,1))->toEqual(terminal()->getCsi() . "1;1f");
});

test('test absX', function (): void {
    expect(terminal()->cursor()->absX(1))->toEqual(terminal()->getCsi() . "1G");
});

test('test absY', function (): void {
    expect(terminal()->cursor()->absY(1))->toEqual(terminal()->getCsi() . "1d");
});

test('test savePosition', function (): void {
    expect(terminal()->cursor()->savePosition())->toEqual(terminal()->getCsi() . "s");
});

test('test restorePosition', function (): void {
    expect(terminal()->cursor()->restorePosition())->toEqual(terminal()->getCsi() . "u");
});

test('test save', function (): void {
    expect(terminal()->cursor()->save())->toEqual(terminal()->getCsi() . '7');
});

test('test restore', function (): void {
    expect(terminal()->cursor()->restore())->toEqual(terminal()->getCsi() . '8');
});

test('test getCurrentPosition', function (): void {
    expect(terminal()->cursor()->getCurrentPosition())->toBeArray();
    expect(count(terminal()->cursor()->getCurrentPosition()))->toEqual(2);
});