<?php

declare(strict_types=1);

use Termage\Termage;
use function Termage\strikethrough;
use function Termage\render;

test('test strikethrough', function (): void {
    $value = render(strikethrough('RAD'));
    expect($value)->toBe("\e[9mRAD\e[29m" . PHP_EOL);
});