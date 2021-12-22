<?php

declare(strict_types=1);

use Thermage\Thermage;
use function Thermage\paragraph;

test('test paragraph', function (): void {
    putenv('COLUMNS=20');
    $value = paragraph('RAD')->render();
    expect($value)->toBe("\e[0mRAD                 " . PHP_EOL);
});