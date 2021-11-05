<?php

declare(strict_types=1);

use Termage\Termage;
use function Termage\italic;

test('test italic', function (): void {
    $value = italic('RAD')->render();
    expect($value)->toBe("\e[3mRAD\e[23m");
});