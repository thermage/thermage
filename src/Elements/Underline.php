<?php

declare(strict_types=1);

namespace Termage\Elements;

use Termage\Base\Element;

final class Underline extends Element
{
    public function render(): string
    {
        $this->underline();

        return parent::render();
    }
}