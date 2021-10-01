<?php

declare(strict_types=1);

use Clirad\Components\Element;

test('test el helper', function (): void {
    $this->assertInstanceOf(Element::class, el());
});
