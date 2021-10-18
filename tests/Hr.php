<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Elements\Href;

test('test termage rule method', function (): void {
    $this->assertInstanceOf(Rule::class, Thermage::rule());
});