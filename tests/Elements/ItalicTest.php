<?php

declare(strict_types=1);

use Thermage\Thermage;
use function Thermage\italic;

test('test italic', function (): void {
    $value = italic('RAD')->renderToString();
    expect($value)->toBe("\e[3mRAD\e[23m");
});