<?php

declare(strict_types=1);

use Termage\Termage;
use function Termage\strikethrough;

test('test strikethrough', function (): void {
    $value = strikethrough('RAD')->render();
    expect($value)->toBe("\e[9mRAD\e[29m");
});