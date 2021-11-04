<?php

declare(strict_types=1);

use Termage\Termage;
use function Termage\paragraph;

test('test paragraph', function (): void {
    putenv('COLUMNS=20');
    $value = paragraph('RAD')->render();
    expect($value)->toBe(PHP_EOL . "RAD                 " . PHP_EOL);
});