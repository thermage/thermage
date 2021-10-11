<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Base\Theme;
use Termage\Components\Rule;

test('test termage rule method', function (): void {
    $this->assertInstanceOf(Rule::class, termage()->rule());
});