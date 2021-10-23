<?php

declare(strict_types=1);

use Termage\Termage;
use function Termage\paragraph;

test('test paragraph', function (): void {
    $value = paragraph('RAD')->render();
    expect($value)->toBe("RAD" . PHP_EOL);
});