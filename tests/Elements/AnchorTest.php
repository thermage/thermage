<?php

declare(strict_types=1);

use Thermage\Thermage;
use function Thermage\anchor;

test('test anchor href', function (): void {
    $value = anchor('Thermage')->href('https://digital.flextype.org/thermage/')->renderToString();
    expect($value)->toEqual("\e]8;;" . "https://digital.flextype.org/thermage/" . "\e\\" . "Thermage" . "\e]8;;\e\\");
});
