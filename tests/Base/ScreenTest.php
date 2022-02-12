<?php

declare(strict_types=1);

use Thermage\Base\Screen;
use function Thermage\terminal;

test('test eraseSavedLines', function (): void {
    expect(terminal()->screen()->eraseSavedLines())->toEqual(terminal()->getCsi() . '3J');
});

test('test eraseAll', function (): void {
    expect(terminal()->screen()->eraseAll())->toEqual(terminal()->getCsi() . '2J');
});