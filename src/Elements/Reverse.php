<?php

declare(strict_types=1);

namespace Termage\Elements;

use Termage\Base\Element;

final class Reverse extends Element
{
    public function render(): string
    {
        $this->reverse();

        return parent::render();
    }
}