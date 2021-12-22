<?php

declare(strict_types=1);

use Thermage\Thermage;
use function Thermage\bold;

test('test bold', function (): void {
    $value = bold('RAD')->render();
    expect($value)->toBe("\e[1mRAD\e[22m");
});