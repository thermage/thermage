<?php

declare(strict_types=1);

use Thermage\Base\Screen;
use function Thermage\getCsi;
use function Thermage\getEsc;

test('test eraseSavedLines', function (): void {
    expect(Screen::eraseSavedLines())->toEqual(getCsi() . '3J');
});

test('test eraseAll', function (): void {
    expect(Screen::eraseAll())->toEqual(getCsi() . '2J');
});