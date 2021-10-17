<?php

declare(strict_types=1);

namespace Termage\Elements;

use Termage\Base\Element;

final class Blink extends Element
{
    public function render(): string
    {
        $this->blink();

        return parent::render();
    }
}