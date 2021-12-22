<?php

declare(strict_types=1);

use Thermage\Thermage;
use function Thermage\strikethrough;

test('test strikethrough', function (): void {
    $value = strikethrough('RAD')->render();
    expect($value)->toBe("\e[9mRAD\e[29m");
});