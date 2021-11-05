<?php

declare(strict_types=1);

use Termage\Termage;
use function Termage\anchor;

test('test anchor href', function (): void {
    $value = anchor('Termage')->href('https://digital.flextype.org/termage/')->render();
    expect($value)->toEqual("\e]8;;" . "https://digital.flextype.org/termage/" . "\e\\" . "Termage" . "\e]8;;\e\\");
});
