<?php

declare(strict_types=1);

use Termage\Termage;
use function Termage\paragraph;
use function Termage\render;

test('test paragraph', function (): void {
    putenv('COLUMNS=20');
    $value = render(paragraph('RAD'));
    expect($value)->toBe("RAD                 " . PHP_EOL);
});