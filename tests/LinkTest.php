<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Base\Theme;
use Termage\Components\Link;

test('test termage link method', function (): void {
    $this->assertInstanceOf(Link::class, termage()->link());
});

test('test link href', function (): void {
    $value = termage()->link('Termage')->href('https://digital.flextype.org/termage/')->render();
    expect($value)->toEqual("<href=https://digital.flextype.org/termage/>Termage</>");
});
