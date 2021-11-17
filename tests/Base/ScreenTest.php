<?php

declare(strict_types=1);

use Termage\Base\Screen;
use function Termage\getCsi;
use function Termage\getEsc;

test('test eraseSavedLines', function (): void {
    expect(Screen::eraseSavedLines())->toEqual(getCsi() . '3J');
});

test('test eraseAll', function (): void {
    expect(Screen::eraseAll())->toEqual(getCsi() . '2J');
});

test('test eraseAbove', function (): void {
    expect(Screen::eraseAbove())->toEqual(getCsi() . '1J');
});

test('test eraseBelow', function (): void {
    expect(Screen::eraseAbove())->toEqual(getCsi() . '0J');
});