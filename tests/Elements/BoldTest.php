<?php

declare(strict_types=1);

use Thermage\Thermage;
use function Thermage\bold;

test('test bold', function (): void {
    $value = bold('RAD')->renderToString();
    expect($value)->toBe("\e[1mRAD\e[22m");
});