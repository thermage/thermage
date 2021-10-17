<?php

declare(strict_types=1);

namespace Termage\Elements;

use Termage\Base\Element;

final class Italic extends Element
{
    public function render(): string
    {
        $this->italic();

        return parent::render();
    }
}