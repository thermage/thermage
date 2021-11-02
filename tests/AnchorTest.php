<?php

declare(strict_types=1);

use Termage\Termage;
use function Termage\anchor;
use function Termage\render;

test('test anchor href', function (): void {
    $value = render(anchor('Termage')->href('https://digital.flextype.org/termage/'));
    expect($value)->toEqual("\e]8;;" . "https://digital.flextype.org/termage/" . "\e\\" . "Termage" . "\e]8;;\e\\" . "\n");
});
