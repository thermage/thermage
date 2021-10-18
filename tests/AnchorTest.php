<?php

declare(strict_types=1);

use Termage\Termage;
use Termage\Elements\Anchor;

test('test anchor href', function (): void {
    $value = Termage::link('Termage')->href('https://digital.flextype.org/termage/');
    expect($value)->toEqual("[link href=https://digital.flextype.org/termage/]Termage[/link][/p][/m]");
});
