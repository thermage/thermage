<?php

declare(strict_types=1);

use Termage\Termage;
use function Termage\italic;
use function Termage\render;

test('test italic', function (): void {
    $value = render(italic('RAD'));
    expect($value)->toBe("\e[3mRAD\e[23m" . PHP_EOL);
});