<?php

declare(strict_types=1);

use Termage\Termage;
use function Termage\underline;
use function Termage\render;

test('test underline', function (): void {
    $value = render(underline('RAD'));
    expect($value)->toBe("\e[4mRAD\e[24m" . PHP_EOL);
});