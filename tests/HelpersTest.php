<?php

declare(strict_types=1);

use Termage\Termage;

test('test termage helper', function (): void {
    $this->assertInstanceOf(Termage::class, termage());
});
