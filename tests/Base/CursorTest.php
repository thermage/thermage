<?php

declare(strict_types=1);

use Thermage\Base\Cursor;
use function Thermage\getCsi;
use function Thermage\getEsc;

test('test show', function (): void {
    expect(Cursor::show())->toEqual(getCsi() . '?25h');
});

test('test hide', function (): void {
    expect(Cursor::hide())->toEqual(getCsi() . '?25l');
});

test('test up', function (): void {
    expect(Cursor::up(1))->toEqual(getCsi() . "1A");
});

test('test upLine', function (): void {
    expect(Cursor::upLine(1))->toEqual(getCsi() . "1F");
});

test('test downLine', function (): void {
    expect(Cursor::downLine(1))->toEqual(getCsi() . "1E");
});

test('test down', function (): void {
    expect(Cursor::down(1))->toEqual(getCsi() . "1B");
});

test('test forward', function (): void {
    expect(Cursor::forward(1))->toEqual(getCsi() . "1C");
});

test('test back', function (): void {
    expect(Cursor::back(1))->toEqual(getCsi() . "1D");
});

test('test goTo', function (): void {
    expect(Cursor::goTo(1,1))->toEqual(getCsi() . "1;1f");
});

test('test absX', function (): void {
    expect(Cursor::absX(1))->toEqual(getCsi() . "1G");
});

test('test absY', function (): void {
    expect(Cursor::absY(1))->toEqual(getCsi() . "1d");
});

test('test savePosition', function (): void {
    expect(Cursor::savePosition())->toEqual(getCsi() . "s");
});

test('test restorePosition', function (): void {
    expect(Cursor::restorePosition())->toEqual(getCsi() . "u");
});

test('test save', function (): void {
    expect(Cursor::save())->toEqual(getEsc() . '7');
});

test('test restore', function (): void {
    expect(Cursor::restore())->toEqual(getEsc() . '8');
});

test('test getCurrentPosition', function (): void {
    expect(Cursor::getCurrentPosition())->toBeArray();
    expect(count(Cursor::getCurrentPosition()))->toEqual(2);
});