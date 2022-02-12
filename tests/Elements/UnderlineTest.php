<?php

declare(strict_types=1);

use Thermage\Thermage;
use function Thermage\underline;

test('test underline', function (): void {
    $value = underline('RAD')->renderToString();
    expect($value)->toBe("\e[4mRAD\e[24m");
});